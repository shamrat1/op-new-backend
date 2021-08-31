<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BetOptionDetail;
use App\BetsForMatch;

class BetOption extends Model
{
    protected $fillable = [
    	"name",
    	"description",
        "isMultipleSupported"
    ];
    
    public function forMatch(){
    	return $this->hasMany(BetsForMatch::class);
    }

    public function optionDetails(){
    	return $this->hasMany(BetOptionDetail::class);
    }

    public function betsForMatch(){
        return $this->hasMany(BetsForMatch::class);
    }

    public function isUsed(){

    }
}
