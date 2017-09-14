<?php

namespace App\Repositories;

use App\Sidebar;

class SidebarsRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Sidebar $Sidebar)
    {
        $this->model = $Sidebar;
    }

    /**
     * 获取所有菜单
     */
    public function getAllSidebar()
    {
        return $this->model->get()->toArray();
    }

    /**
     * 获取顶级菜单
     */
    public function getOptionSidebar()
    {
        return $this->model->select(['id','name','pid'])->get();
    }

    /**
     * 获取菜单
     */
    public function getSidebar($id)
    {
        return $this->getById($id);
    }

    /**
     * 修改菜单
     * 
     * @param  [type] $post  [description]
     * @return [type]        [description]
     */
    public function createSidebar($post)
    {
        $input = [];
        $input['name'] = $post['name'];
        $input['purview_flag'] = !empty($post['purview_flag']) ? $post['purview_flag'] : '';
        $input['url'] = !empty($post['url']) ? $post['url'] : '';
        $input['class'] = !empty($post['class']) ? $post['class'] : '';
        $input['pid'] = !empty($post['pid']) ? $post['pid'] : '0';

        return $this->store($input);
    }

    /**
     * 修改菜单
     * 
     * @param  [type] $id    [description]
     * @param  [type] $post  [description]
     * @return [type]        [description]
     */
    public function updateSidebar($id,$post)
    {
        $input = [];
        $input['name'] = $post['name'];
        $input['purview_flag'] = !empty($post['purview_flag']) ? $post['purview_flag'] : '';
        $input['url'] = !empty($post['url']) ? $post['url'] : '';
        $input['class'] = !empty($post['class']) ? $post['class'] : '';
        $input['pid'] = !empty($post['pid']) ? $post['pid'] : '0';

        return $this->update($id,$input);
    }

    /**
     * 获取后台菜单
     */
    public function getAdminMenus()
    {
        $adminMenus = $this->model->select(['id','name','pid','class','url'])->get()->toArray();
        return genTree($adminMenus);
    }
}
