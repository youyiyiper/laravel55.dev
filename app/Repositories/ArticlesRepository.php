<?php

namespace App\Repositories;

use App\Article;

class ArticlesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Article $Article)
    {
        $this->model = $Article;
    }


    /**
     * 检查是否存在被使用
     */
    public function checkCategoryIsUsed($id)
    {
        $res = $this->getOneByWhere(array('category_id' => $id));
        return empty(current($res)) ? true : false;
    }

    public function getOneByCategoryId($category_id)
    {

    }
}