<?php
namespace App\Http\Traits;
use App\User;

trait UserCredit {
    
    public function getCredit(Int $userID)
    {   
        $user = User::find($userID);
        return empty($user->credit) ? 0 : $user->credit->amount;
    }
}
