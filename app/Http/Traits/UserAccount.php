<?php

namespace App\Http\Traits;
use App\User;
use App\Club;
use App\PlacedBet;
use App\BetOption;
use App\Transaction;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


trait UserAccount{
    public function getProfile()
    {
        $user = auth()->user()->load('club');
        return view('pages.account.viewProfile',compact('user'));
    }

    public function getEditProfileForm()
    {
        $user = auth()->user();
        return view('pages.account.editProfile',compact('user'));
    }
    public function updateProfile(Request $request, $id)
    {
        /*dd($request->all());*/
         $this->validate($request,[
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'country' => 'required'
        ]);
        $user = User::find($id);

        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->country = $request->country;

        $user->save();

        return redirect()->back();

    }

    public function getClubChangeForm(Request $request)
    {
         $clubs = Club::all();
        //  $this->validate($request,[
        //     'club' => 'required_unless:sponser,null|integer|exists:clubs,id'
        // ]);


        return view('pages.account.changeClub')->with('clubs', $clubs);
    }

    public function updateClub(Request $request)
    {
        $this->validate($request,[
            'club_id'=>'required|exists:clubs,id',
            'password'=>'current_password'
        ]);

        $id = auth()->user()->id;
        $user = User::find($id);
        $user->club_id = $request->club_id;
        $user->update();
        alertify("Club Updated.");
        return redirect()->back();
    }

    public function getFollowers()
    {
        $user = auth()->user();
        $isClubOwner = $user->hasRole('Club Owner');
        if($isClubOwner ){
            $club = Club::where('user_id',$user->id)->first();
            if(!$club)
                return redirect()->back()->with(['status' => 'Request cannot be completed. try again.']);
            $followers = User::with('placedBets','placedBets.match')
            ->where('club_id',$club->id)->get();
            $type = $club;
        }else{
            $followers = User::where('sponser_email',$user->email)->get();
            $type = 'sponser';
        }
       return view('pages.account.followers',compact('followers','type'));
    }

    public function getBetHistory()
    {
        $id = auth()->user()->id;
        $placedBets = PlacedBet::where('user_id',$id)
            ->with('match','match.tournament','betDetail','betDetail.betsForMatch','betDetail.betsForMatch.betOption')
            ->latest()
            ->paginate(20);
        $totalMatches = PlacedBet::where('user_id', $id)->select('match_id')->distinct()->get();

        return view('pages.account.myBets',compact('placedBets','totalMatches'));
    }

    public function getStatement()
    {
        $transactions = Transaction::where('user_id',auth()->user()->id)->orderBy('id', 'desc')->paginate(20);
        // dd($transactions->first()->sponsered_by);
        return view('pages.account.statement',compact('transactions'));
    }
    public function getPasswordChangeForm(Request $request)
    {

        return view('pages.account.changePass');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required|current_password',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $password = Hash::make($request->password);
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->password = $password;
        $user->update();

        Auth::logout();
        return redirect()->route('login');
    }

}

?>
