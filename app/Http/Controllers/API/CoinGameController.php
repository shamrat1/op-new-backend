<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinGameController extends Controller
{
    public function start(Request $request)
    {
        // check if user has enough credit
        
        // check if rate is ok

        return response()->json([
            'status' => "ok",
            'msg' => "fetched",
            "isWin" => (bool) rand(0,1),
        ]);
    }
}
