<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Article;

class CategorysRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Category $Category)
    {
        $this->model = $Category;
    }

    /**
     * 获取列表
     * 
     * @return array
     */
    public function getCategorysLists()
    {
        return $this->model->latest()->where(array('status' => 1))->get();
    }

    /**
     * 获取option列表
     * 
     * @return array
     */
    public function getOptionLists()
    {
        return $this->model->select(['id','name','pid'])->get();
    }

    /**
     * 添加
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function createCategory($post)
    {
        $input['name'] = $post['name'];
        $input['desc'] = $post['desc'];
        $input['flag'] = $post['flag'];
        $input['pid'] = !empty($post['pid']) ? $post['pid'] : 0;

        return $this->store($input);
    }

    /**
     * 修改
     * 
     * @param  [type] $id   [description]
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function updateCategory($id,$post)
    {
        $input['name'] = $post['name'];
        $input['desc'] = $post['desc'];
        $input['flag'] = $post['flag'];
        $input['pid'] = !empty($post['pid']) ? $post['pid'] : 0;

        return $this->update($id,$input);
    }
}