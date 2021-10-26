<?php

namespace App\Http\Controllers\API;

use App\Credit;
use App\GameHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use DB;
use Exception;
use Validator;

class GameHistoryController extends Controller
{

    
    public function placeHistory(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(),[
            "game_type" => "required|string",
            "rate" => "nullable|string",
            "value" => "required|numeric",
            "amount" => "required|numeric"
        ]);

        // return if validation fails
        if($validator->fails()){
            return response()->json($validator->messages(),422);
        }

        try{
            DB::beginTransaction();
            $data = $validator->validated();
            $user = auth("api")->user();
            $data["user_id"] = $user->id;
            $gameHistory = GameHistory::create($data);

            $credit = Credit::where('user_id', $user->id)->first();
            $credit->amount = $credit->amount - $request->amount;
            $credit->update();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->type = "onGame";
            $transaction->amount = round($request->amount);
            $transaction->status = "approved";
            $transaction->mobile = 0;
            $transaction->save();

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(),422);
        }
        return response()->json(["gameHistory" => $gameHistory,"credits" => $user->credit->amount]);
    }

    public function verifyHistory(Request $request,$id)
    {
        $user = auth("api")->user();
        $gameHistory = GameHistory::where("id",$id)->where("user_id",$user->id)->firstOrFail();

        try{
            DB::beginTransaction();
            $gameHistory->score = $request->score;

            if($gameHistory->status == "pending" && $request->has("result") && $request->result == "win"){
                $amount = round($gameHistory->amount * $gameHistory->value);

                $gameHistory->status = "win";

                $credit = Credit::where('user_id', $user->id)->first();
                $credit->amount = $credit->amount + $amount;
                $credit->update();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->type = "gameWin";
                $transaction->amount = $amount;
                $transaction->status = "approved";
                $transaction->mobile = 0;
                $transaction->save();

            }else{
                $gameHistory->status = "loss";
            }
            $gameHistory->update();

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(),422);
        }
        return response()->json(["gameHistory" => $gameHistory,"reward" => $amount ?? 0]);

    }
}
