<?php

namespace App\Repositories;

use App\Models\Config;

class ConfigsRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Config $Config)
    {
        $this->model = $Config;
    }

    /**
     * 获取标签列表
     */
    public function getConfigLists()
    {
        return $this->model->select(['id','name','keyword','created_at','updated_at'])->orderBy('name', 'asc')->paginate(1);
    }

    /**
     * 添加
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */    
    public function createConfig($post)
    {
        $input['name'] = $post['name'];
        $input['keyword'] = $post['keyword'];
        $input['content'] = $post['content'];
        return $this->store($input);        
    }

    /**
     * 修改
     * 
     * @param  [type] $id   [description]
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function updateConfig($id,$post)
    {
        $input['name'] = $post['name'];
        $input['keyword'] = $post['keyword'];
        $input['content'] = $post['content'];
        return $this->update($id,$input);
    }    
}