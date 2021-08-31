<?php
namespace App\Http\Traits;
use App\User;
use App\Credit;
use App\Club;
use App\Transaction;
use Log;

trait BetCommission {

    public function commissionCalculation(Int $percent, Int $totalAmount)
    {
        return $totalAmount * ($percent/100);
    }

    public function sponserCommission(Int $sponseredFromId,$email,Float $amount){
        $user = User::whereEmail($email)->first();
        if($user != null){
            $credit = Credit::where("user_id",$user->id)->first();
        $credit->amount += $amount;
        $credit->update();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'sponsered',
            'amount' => $amount,
            'status' => "approved",
            'txn_id' => $sponseredFromId,
            'mobile' => 0
        ]);
        Log::channel('activity')->notice("Sponser commission is given to $email of $amount");
        }
    }

    public function clubCommission(Int $sponseredFromId,Club $club,Float $amount){
        $owner = User::find($club->user_id);
        if($owner != null){
            $credit = Credit::where('user_id',$owner->id)->first();
            $credit->amount += $amount;
            $credit->update();
    
            Transaction::create([
                'user_id' => $owner->id,
                'type' => 'sponsered',
                'amount' => $amount,
                'status' => "approved",
                'txn_id' => $sponseredFromId,
                'mobile' => 0
            ]);
            Log::channel('activity')->notice("Club commission is given to $owner->email of $amount");
        }
    }
}

?>