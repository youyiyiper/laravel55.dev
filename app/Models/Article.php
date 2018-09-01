<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
	protected $dates = ['published_at'];

    protected $fillable = [
        'title',
        'is_top',
        'desc',
        'category_id',
        'status',
        'content',
        'published_at',
    ];

    //自动对字段进行格式处理
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i:s',$date);
    }
}
