<?php

namespace App\Repositories;

use App\Tag;

class TagsRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Tag $Tag)
    {
        $this->model = $Tag;
    }

    /**
     * 获取标签列表
     */
    public function getTagLists()
    {
        return $this->model->select(['id','name'])->get();
    }
}