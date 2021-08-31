<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackActivity extends Model
{
    protected $fillable = [
        'author', 'author_roles', 'before', 'after', 'model'
    ];
}
