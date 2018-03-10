<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable = [
        'name',
        'url',
        'class',
        'pid',
    ];
}
