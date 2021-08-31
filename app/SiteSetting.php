<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'betting',
        'backend_number',
        'notice',
        'withdraw_date',
        'isWithdrawable',
        'isDepositable'
    ];
}
