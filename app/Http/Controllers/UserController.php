<?php

namespace App\Http\Controllers;

use App\Club;
use App\Credit;
use App\TrackActivity;
use Illuminate\Http\Request;
use App\User;
use App\Role;
Use App\PlacedBet;
use App\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
		$users = User::with('roles','credit','club')
		->when($request->username,function($q) use ($request){
			$q->where('username', 'LIKE', '%' . $request->username . '%');
		})
		->when($request->created_at,function($q) use ($request){
			$q->whereDate('created_at', '>=', $request->created_at);
		})
		->when($request->credit,function($q) use ($request){
			$q->whereHas('credit',function($r) use ($request){
				$r->where('amount','>=',$request->credit);
			});
		})
		->when($request->club_id,function($q) use ($request){
			$q->where('club_id', $request->club_id);
		})
		->orderBy('id','desc')->paginate(20)
		->appends([
			'username' => request('username'),
			'credit' => request('credit'),
			'created_at' => request('created_at'),
			'club_id' => request('club_id')
			]);
		$clubs = Club::select('id','name')->get();
		$totalCredit = Credit::sum('amount');
    	return view('admin.user.index',compact(['users','clubs','totalCredit']));
    }


    public function edit($id){

		$roles = Role::all();
		$clubs = Club::all();
    	$user = User::find($id);
		$totalBetWin = Transaction::where('user_id',$user->id)->where('status','approved')->where('type','betWin')->sum('amount');
		$totalOnBet = Transaction::where('user_id',$user->id)->where('status','approved')->where('type','onBet')->sum('amount');
    	return view('admin.user.edit',compact(['roles','user','clubs','totalBetWin','totalOnBet']));
    }

    public function show($id){
    	$user = User::find($id);
        $bets = PlacedBet::where('user_id',$id)->with('match','betDetail.betsForMatch.betOption')->get();
        $transactions = Transaction::where('user_id',$id)->orderBy('id','desc')->paginate(20);

    	return view('admin.user.show',compact(['user','bets','transactions']));
	}

	public function update($id,Request $request){
		$this->validate($request,[
			'name' => 'required',
			'username' => 'required|exists:users,username',
			'email' => 'required'
		]);
		$sponser = User::where('username',$request->sponser)->first();
		$sponserEmail = $sponser != null ? $sponser->email : "";
		$before = User::where('id',$id)->select(['name','username','email','club_id','country','mobile','sponser_email','banned_until'])->with(['club:id,name'])->first()->toJson();
		User::find($id)->update([
			'name' => $request->input('name'),
			'username' => $request->input('username'),
			'email' => $request->input('email'),
			'club_id' => $request->input('club_id'),
			'country' => $request->input('country'),
			'mobile' => $request->input('mobile'),
			'sponser_email' => $sponserEmail,
			'banned_until' => $request->banned_until,
			'is_allowed_transaction' => $request->has('is_allowed_transaction') ? true : false,
		]);
        // $after = User::where('id',$id)->select(['name','username','email','club_id','country','mobile','sponser_email','banned_until'])->with(['club:id,name'])->first()->toJson();
        // TrackActivity::create([
        //     'author' => auth()->user()->username,
        //     'model' => 'Profile Changed',
        //     'before' => $before,
        //     'after' => $after
        // ]);
        alertify()->success('User Info Updated.')->position('bottom right');
		return redirect()->route('user.index');
	}

	public function updatePassword($id,Request $request){
		$this->validate($request,[
			'password' => 'required|string|min:8|confirmed'
		]);
		$before = User::where('id',$id)->select(['username'])->first()->toJson();
		User::find($id)->update([
			'password' => Hash::make($request->input('password')),
		]);
        $after = User::where('id',$id)->select(['username'])->first()->toJson();;
        // TrackActivity::create([
        //     'author' => auth()->user()->username,
        //     'model' => 'Password Changed',
        //     'before' => $before,
        //     'after' => $after
        // ]);
		alertify()->success('User Password Updated.')->position('bottom right');
		return redirect()->route('user.index');
	}
	public function updateCredit($id, Request $request)
	{
		$this->validate($request,[
			'credit' => 'required|numeric'
		]);
        $before = User::where('id',$id)->with(['credit:id,user_id,amount'])->select(['id','username'])->first()->toJson();
		Credit::where('user_id',$id)->first()->update([
			'amount' => $request->input('credit')
		]);
        $after = User::where('id',$id)->with(['credit:id,user_id,amount'])->select(['id','username'])->first()->toJson();
        // TrackActivity::create([
        //    'author' => auth()->user()->username,
        //     'before' => $before,
        //     'after' => $after,
        //     'model' => 'Credit'
        // ]);
		alertify()->success('User Credit Updated.')->position('bottom right');
		return redirect()->back();
	}
    public function role(Request $request,$id){
    	// dd($request->all());
    	$validData = $request->validate([
    		"roles" => "required",
    		"roles.*" => "required|integer"
    	]);

    	$user = User::find($id);

    	$user->roles()->sync($request->roles);

    	return redirect()->back();
	}
	public function destroy($id,Request $request)
	{
		$user = User::find($id);
		try{
			DB::beginTransaction();
			$user->transactions()->delete();
			$user->ownClub()->delete();
			$user->credit()->delete();
			$user->placedBets()->delete();
			$user->delete();
			DB::commit();
			return redirect()->back()->with('success','deleted successfully.');
		}catch (Exception $e){
			DB::rollBack();
			return redirect()->back()->with('error','deleting failed.');
		}

	}

}
