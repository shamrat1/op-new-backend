<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = [
        "user_id",
        "amount",
        "bonus_point"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
