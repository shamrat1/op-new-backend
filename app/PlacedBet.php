<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacedBet extends Model
{
    /*
     * To place a bet user request will hold following data.
     * 1. user_id
     * 2. bets_for_match_id
     * 3. amount
     * 4. bet_name
     * 5. bet_value
     */
   protected $fillable = [
    "user_id",
    "match_id",
    "transaction_id",
   	"bet_option_detail_id",
   	"amount",
   	"bet_name",
    "bet_value",
    "isWin",
   ];

   public function user(){
     return $this->belongsTo(User::class);
   }

   public function betDetail(){
     return $this->belongsTo(BetOptionDetail::class,'bet_option_detail_id');
   }

   public function match(){
     return $this->belongsTo(Match::class);
   }

   public function transaction(){
     return $this->belongsTo(Transaction::class);
   }

   public function win()
   {
     return $this->hasOne(BetsForMatch::class,'correctBet','bet_option_detail_id');
   }

  public function isCorrect($id)
  {
    $res = BetsForMatch::where('correctBet', '=', $id)->get();
    
    if(empty($res)){
      return "not set";
    }

    if (!empty($res)  && count($res) > 0) {
      return true;
    }
    return false;
  }

  public function getIsWinAttribute()
  {
    return $this->win != null ? true : false;
  }
}
