<?php

namespace App\Http\Controllers\API;

use App\Credit;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthenticationController extends Controller{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['nullable', 'string', 'max:255'],
            'username' => ['required','string','min:4','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required','string','min:4'],
            'sponser' => ['nullable','string','max:255','exists:users,username'],
            'mobile' => ['required','numeric','digits_between:11,13'],
            'club_id' => ['nullable','numeric']
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $data = $request->all();
        $sponser = User::where('username',$data["sponser"])->first();
        // dd(empty($data['club_id']));
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'mobile' => $data['mobile'],
            'sponser_email' => empty($sponser->email) ? 'onplay365@gmail.com' : $sponser->email,
            'club_id' => (empty($data['club_id']) || $data['club_id'] == 0) ? 1 : $data['club_id']
        ]);

        Credit::create([
            'user_id' => $user->id,
            'amount' => 0
        ]);

        return response()->json([
            "status" => "OK",
        ]);

    }

    public function login(Request $request)
    {

        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            // if($user->status){
                $token =  $user->createToken('op365-2021')->accessToken;
                $user['token'] = $token;
                $user->credit;

                $this->giveAppSigninBonus($request,$user);
                
                return response()->json(
                    [
                        'status' => "ok",
                        'msg' => "login successful",
                        "user" => $user,
                    ]
                );
            // }else{
            //     return response()->json([
            //         'status' => "failed",
            //         'msg' => "User Account is not active. Contact Adminstration",
            //         "data" => []
            //     ], 200);
            // }
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 419);
        }
    }

    private function giveAppSigninBonus(Request $request, User $user)
    {
        if($request->has("device_id")){
            $devices = User::where("device_id",$request->device_id)->count();
            if($devices == 0){
                $user = User::find($user->id);
                $user->update(["device_id" => $request->device_id]);
                
                $credit = $user->credit;
                $credit->amount += 10;
                $credit->update();
                
                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'App Login Bonus',
                    'amount' => 10,
                    'status' => "approved",
                    'mobile' => 0
                ]);
            }
        }
    }
}