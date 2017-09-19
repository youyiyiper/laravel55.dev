<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'is_top',
        'desc',
        'category_id',
        'status',
        'content',
    ];
}
