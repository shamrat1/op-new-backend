<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BetOption;

class BetOptionDetail extends Model
{
    protected $fillable = [
        'name','value','bets_for_match_id'
    ];

    public function betsForMatch(){
        return $this->belongsTo(BetsForMatch::class);
    }

    public function bids(){
        return $this->hasMany(PlacedBet::class);
    }

    
}
