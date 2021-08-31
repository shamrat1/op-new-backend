<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /*
     * Transaction Request will hold
     *
     * 1. user id
     * 2. mobile no
     * 3. transaction id [ could be nullable, in case withdraw]
     * 4. type [ cash in, withdraw ]
     * 5. status [ approved, pending, canceled ]
     */

	protected $fillable = [
		"user_id",
		"mobile",
        "amount",
        "backend_mobile",
		"txn_id",
		"type",
        "payment_type",
        "payment_method",
        "status"

	];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sponsered()
    {
        return $this->belongsTo(User::class,'txn_id');
    }

    public function getSponseredByAttribute()
    {
        if($this->txn_id > 0){
            return $this->sponsered->username;
        }
        return null;
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }
}
