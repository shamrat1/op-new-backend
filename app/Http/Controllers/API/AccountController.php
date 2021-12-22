<?php

namespace App\Http\Controllers\API;

use App\BetSetting;
use App\Credit;
use App\Http\Controllers\Controller;
use App\PlacedBet;
use App\Setting;
use App\SiteSetting;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AccountController extends Controller{

    public function storeDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11",
            // "password" => "required|current_password",
            // "txn_id" => "nullable",
            "amount" => "required|numeric",
            "backend_mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10"
       ]);

       if($validator->fails()){
           return response()->json($validator->messages(),401);
       }

       Transaction::create([
            'user_id' => auth('api')->id(),
            'mobile' => $request->input('mobile'),
            'backend_mobile' => $request->input('backend_mobile'),
            // 'txn_id' => $request->input('txn_id'),
            'type' => 'deposit',
            'payment_method' => $request->input('payment_method'),
            'amount' => $request->input('amount'),
            'status' => 'pending'
       ]);

       return response()->json($this->getBasicResponse("ok","New Deposit Request added."));
    }

    public function storeWithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11",
            "amount" => "required|numeric",
            "password" => "required|current_password",
            "payment_type" => "nullable|string"
       ]);
       if($validator->fails()){
            return response()->json($validator->messages(),401);
        }
       $user = auth('api')->user();
       // dd($user->credit->amount);
       if ($request->amount <= $user->credit->amount - 20 && $user->mobile != null) {
            Transaction::create([
                 "user_id" => $user->id,
                 "type" => "withdraw",
                 "mobile" => $request->input('mobile'),
                 "payment_type" => $request->input('payment_type'),
                 "payment_method" => $request->input('payment_method'),
                 "amount" => $request->input('amount'),
                 'txn_id' => 'ATWB-' . $user->credit->amount
            ]);
            $credit = Credit::where('user_id', $user->id)->first();
            $credit->amount = $credit->amount - $request->input('amount');
            $credit->update();

            return response()->json($this->getBasicResponse("ok","New Withdraw request added"));
       }
       return response()->json([
        'status' => "failed"
       ],419);
    }

    public function updateUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(),[
			'name' => 'required',
			'username' => 'required|exists:users,username',
			'email' => 'required',
            'new_password' => 'nullable|min:8',
            'new_password_confirmation' => 'required_with:new_password|same:new_password',
            "password" => "required|min:8|current_password"
		]);
        if($validator->fails()){
            return response()->json($validator->messages(),401);
        }
		$sponserEmail = User::where('username',$request->sponser)->first()->email;
		User::find(auth('api')->id())->update([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'club_id' => $request->input('club_id'),
			'country' => $request->input('country'),
			'mobile' => $request->input('mobile'),
		]);

        if($request->has('new_password') && $request->password != null){
            User::find(auth('api')->id())->update([
                'password' => Hash::make($request->new_password),
            ]);
        }
        return response()->json($this->getBasicResponse("ok","User Information Updated"));
    }

    public function userInfo()
    {
        return response()->json($this->getBasicResponse("ok","User Information Fetched"));
    }

    public function getTransactions(String $type = null)
    {
        $transactions = Transaction::where('user_id',auth('api')->id())
        ->when($type,function($q) use($type){
            return $q->where("type",$type);
        })
        ->orderBy('id','desc')
        ->paginate(20);

        return response()->json([
            'status' => "ok",
            'msg' => "fetched",
            "transactions" => $transactions,
        ]);
    }

    public function betHistory()
    {
        $bets = PlacedBet::where('user_id',auth('api')->id())->latest()->with('match','betDetail.betsForMatch.betOption')->paginate(20);
        return response()->json([
            'status' => "ok",
            'msg' => "fetched",
            "placedBets" => $bets,
        ]);
    }

    public static function getBasicResponse($status = "ok",$message = "successful",$token = null)
    {
        $user = auth('api')->user();
        if($token != null){
            $user->token = $token;
        }
        $user->load("credit");
        return [
            'status' => $status,
            'msg' => $message,
            "user" => $user,
        ];
    }

    public function getSettings()
    {
        return response()->json([
            "settings" => Setting::get(),
            "site_setting" => SiteSetting::first(),
            "bet_setting" => BetSetting::first(),
        ]);
    }
}