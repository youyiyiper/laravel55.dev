<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable = [
        'name',
        'purview_flag',
        'url',
        'class',
        'pid',
    ];
}
