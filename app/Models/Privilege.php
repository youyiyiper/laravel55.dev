<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'flag',
        'pid',
    ];
}
