<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    protected $fillable = [
        "user_id", "game_type", "rate", "value", "status", "score", "amount"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
