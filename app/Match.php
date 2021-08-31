<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tournament;

class Match extends Model
{
    protected $fillable = [
    	"name",
    	"match_time",
    	"status",
        "unique_id",
    	"team1",
    	"team2",
        "tournament_id",
        "sport_type",
        "tournament_match_no",
        "score"
    ];

    public function tournament(){
    	return $this->belongsTo(Tournament::class);
    }

    public function betsForMatch(){
        return $this->hasMany(BetsForMatch::class);
    }

    public function bids(){
        return $this->hasMany(PlacedBet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTotalBetAttribute()
    {
        $betsForMatch = collect($this->betsForMatch);
        $bids = collect($this->bids);
        $winningID = $betsForMatch->pluck('correctBet');
        $totalBids = $bids->sum('amount');
        dd($winningID,$bids,$betsForMatch);

        if($winningID->count() > 0){
            $wins = $bids->filter(function($bid) use($winningID){

            });
        }
        $data = ["bid_total"=> $totalBids, "user_win" => 0, "user_lost" => 0];
        return $data;
        
        return $betsForMatch->count();
    }


}
