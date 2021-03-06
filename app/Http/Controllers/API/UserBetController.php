<?php

namespace App\Http\Controllers\API;

use App\BetOptionDetail;
use App\BetSetting;
use App\Credit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\BetCommission;
use App\PlacedBet;
use App\Transaction;
use DB;
use Validator;

class UserBetController extends Controller
{
    use BetCommission;
    
    public function userNewBet(Request $request){

        $Validator = Validator::make($request->all(),[
            "bets-details-id" => "required|exists:bet_option_details,id",
            "match_id" => "required|exists:matches,id",
            "amount" => "required"
        ]);

        if($Validator->fails()){
            return response()->json($Validator->messages(),419);
        }
        $validated = $request->all();
        $betSetting = BetSetting::first();
        if ($request->amount < $betSetting->lowest_amount ||  $request->amount > $betSetting->highest_amount){
            return response()->json("Error placing bet. Try again.",419);
        }

        // $betSetiing = BetSetting::get()->first();
        $details = BetOptionDetail::find($validated['bets-details-id']);
        // check if bet option is live or not 
        $betForMatch = $details->betsForMatch;

            try{
                if ($betForMatch->isLive && $betForMatch->score) {
                    DB::beginTransaction();
                    $amount = $request->amount;

                    $sponserCommission = number_format($this->commissionCalculation(1, $request->amount), 2, '.', '');
                    $clubCommission = number_format($this->commissionCalculation(2, $request->amount), 2, '.', '');
                    $user = auth('api')->user();
                    $credit = Credit::where('user_id', $user->id)->first();

                    // Checking if user has enough amount. if not, redirect with error message
                    if (empty($credit) || $credit->amount < $amount) {
                        return response()->json("Not Enough Credit in account.",419);
                    }

                    $credit->amount = $credit->amount - $amount;
                    $credit->update();
                    // add record in transaction table
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->type = "onBet";
                    $transaction->amount = round($amount);
                    $transaction->status = "approved";
                    $transaction->mobile = 0;
                    $transaction->save();

                    PlacedBet::create([
                        "user_id" => $user->id,
                        "match_id" => $validated['match_id'],
                        "bet_option_detail_id" => $validated['bets-details-id'],
                        "transaction_id" => $transaction->id,
                        "amount" => $validated['amount'],
                        "bet_name" => $details->name,
                        "bet_value" => $details->value,
                    ]);
                    if ($user->sponser_email != null && $details->value >= 1.15) {
                        // give credit to sponser
                        $this->sponserCommission($user->id, $user->sponser_email, $sponserCommission);
                    }
                    if ($user->club_id != null && $details->value >= 1.05) {
                        // give credit to club owner
                        $club = $user->club;
                        $this->clubCommission($user->id, $club, $clubCommission);
                    }
                    DB::commit();
                    return AccountController::getBasicResponse();
                }
                return response()->json("Current Bet Option is not live. Try again later.",400);

            }catch (\Exception $e){
                DB::rollBack();
                return response()->json("Error Placing Bet.",400);
            }
    }
}
