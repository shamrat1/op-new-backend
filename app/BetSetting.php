<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetSetting extends Model
{
    protected $fillable = [
    	'lowest_amount',
    	'highest_amount'
    ];
}
