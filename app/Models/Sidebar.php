<?php

namespace App\Models;

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
