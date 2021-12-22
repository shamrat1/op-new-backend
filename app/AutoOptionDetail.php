<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoOptionDetail extends Model
{
    protected $fillable = [
        "name", "value"
    ];

    public function autoMainOption()
    {
        return $this->belongsToMany(AutoMainOption::class,"main_option_option_detail");
    }
}
