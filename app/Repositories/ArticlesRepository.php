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

    public function getArticlesLists()
    {
        return $this->page(15);
    }

    /**
     * 整合表单输入
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function getInput($post)
    {
        $input['title'] = $post['title'];
        $input['desc'] = $post['desc'];
        $input['content'] = $post['content'];
        $input['is_top'] = !empty($post['is_top']) ? 1 : 0;
        $input['category_id'] = $post['category_id'];
        $input['published_at'] = $post['published_at'];

        return $input;
    }

    /**
     * 添加
     *
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function createArticle($post)
    {
        $input = $this->getInput($post);
        return $this->store($input);
    }

    /**
     * 修改
     *
     * @param  [type] $id   [description]
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function updateArticle($id,$post)
    {
        $input = $this->getInput($post);
        return $this->update($id,$input);
    }

    /**
     * 自动发布文章
     * 
     * @return [type] [description]
     */
    public function autoPublicedArticles()
    {
        return $this->updateData(array('published_at <=' => date('Y-m-d H:i:s'),'status' => 0),array('status' => 1));
    }
}