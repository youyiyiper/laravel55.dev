<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesTag extends Model
{
    protected $table = 'articles_tags';

    public $timestamps = false;

    protected $fillable = [
        'article_id',
        'tag_id',
    ];
}
