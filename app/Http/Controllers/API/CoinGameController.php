<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoinGameController extends Controller
{
    public function start(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "amount" => "required|numeric",
        ]);
        if($validator->fails()){
            return response()->json(["message" => "Amount is invalid. Enter a valid one"],419);
        }

        // check if user has enough credit
        $user = Auth('api')->user();
        
        // check if rate is ok

        return response()->json([
            'status' => "ok",
            'msg' => "fetched",
            "isWin" => (bool) rand(0,1),
        ]);
    }
}
