<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoMainOption extends Model
{
    protected $fillable = [
        "name"
    ];

    public function autoOption()
    {
        return $this->belongsToMany(AutoOption::class,"auto_option_main_option");
    }

    public function autoOptionDetail()
    {
        return $this->belongsToMany(AutoOptionDetail::class,"main_option_option_detail");
    }
}
