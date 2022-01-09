<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        "name",
        "effective_on",
        "status",
        "min_amount",
        "max_amount",
        "status",
        "reward_amount",
        "amount_type",
        "start_date",
        "end_date"
    ];

    protected $date = [
        "start_date",
        "end_date"
    ];
}
