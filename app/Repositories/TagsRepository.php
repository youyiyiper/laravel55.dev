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
        return $this->model->select(['id','name'])->orderBy('name', 'asc')->get();
    }

    /**
     * 添加
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */    
    public function createTag($post)
    {
        $input['name'] = $post['name'];
        return $this->store($input);        
    }

    /**
     * 修改
     * 
     * @param  [type] $id   [description]
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function updateTag($id,$post)
    {
        $input['name'] = $post['name'];
        return $this->update($id,$input);
    }    
}