<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'offer','applies_on','amount','valid_amount','valid_from','valid_till','isActive'
    ];
}
