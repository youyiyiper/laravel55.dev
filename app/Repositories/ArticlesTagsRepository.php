<?php

namespace App\Repositories;

use App\ArticlesTag;

class ArticlesTagsRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(ArticlesTag $ArticlesTag)
    {
        $this->model = $ArticlesTag;
    }

    /**
     * 创建文章标签
     */
    public function createArticleTag($article_id, $tagArr)
    {
        if (empty($tagArr)) {
            return false;
        }

        $temp = [];
        foreach ($tagArr as $key => $tag_id) {
            $temp[$key]['article_id'] = $article_id;
            $temp[$key]['tag_id'] = $tag_id;
        }

        if ($temp) {
            return $this->insertData($temp);
        }

        return false;
    }

    /**
     * 通过文章id获取标签id数组
     *
     * @param $article_id
     * @return array
     */
    public function getTagIdArrByArticleId($article_id)
    {
        $res = $this->all(['article_id' => $article_id]);
        return !empty($res) ? array_pluck($res, 'tag_id') : [];
    }

    /**
     * 检查标签是否已经被用
     * 
     * @param  [type] $tag_id [description]
     * @return [type]         [description]
     */
    public function checkTagsIsUsed($tag_id)
    {
        $res = $this->getOneByWhere(array('tag_id' => $tag_id));
        return empty(current($res)) ? true : false;        
    }
}