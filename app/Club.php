<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');    
    }

    public function getOwnerCreditAttribute(){
        return $this->owner->credit->amount;
    }
}
