<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Match;

class Tournament extends Model
{
    protected $fillable = [
    	"name",
    	"description"
    ];

    public function matches(){
    	return $this->hasMany(Match::class);
    }
}
