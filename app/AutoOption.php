<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoOption extends Model
{
    protected $fillable = [
        "name"
    ];

    public function autoMainOption()
    {
        return $this->belongsToMany(AutoMainOption::class,"auto_option_main_option");
    }
}
