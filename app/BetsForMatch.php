<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BetOption;
use App\BetOptionDetail;
use App\Match;

class BetsForMatch extends Model
{
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'bfm_id',
		"match_id",
		"bet_option_id",
		"correctBet",
		"isLive",
		'score',
		"isResultPublished"
	];
    public function betOption(){
    	return $this->belongsTo(BetOption::class);
    }

    public function match(){
    	return $this->belongsTo(Match::class);
    }

    public function betDetails(){
    	return $this->hasMany(BetOptionDetail::class);
    }
}
