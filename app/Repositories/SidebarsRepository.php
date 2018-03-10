<?php

namespace App\Repositories;

use App\Sidebar;
use App\Repositories\RolesRepository;
use App\Repositories\PrivilegesRepository;

class SidebarsRepository
{
    use BaseRepository;

    protected $model;
    protected $RolesRpt;
    protected $PrivilegesRpt;

    public function __construct(
        Sidebar $Sidebar,
        RolesRepository $RolesRpt,
        PrivilegesRepository $PrivilegesRpt
    )
    {
        $this->model = $Sidebar;
        $this->RolesRpt = $RolesRpt;
        $this->PrivilegesRpt = $PrivilegesRpt;
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
        $temp = array();
        $role_id = session('adminDetail.role_id');
        if ($role_id < 1) {
            return $temp;
        }

        $role_node = session('adminDetail.role_node');
        if (!empty($role_node)) {
            return json_decode($role_node,true);
        }

        $adminMenus = $this->model->select(['id','name','pid','class','url'])->get()->toArray();

        //处理角色权限规则
        $rules = $this->RolesRpt->getRulesByRoleId($role_id);
        if (empty($rules)) {
            return $temp;
        } 

        //通过权限规则获取权限
        $privileges = $this->PrivilegesRpt->getPrivilegesByRules($rules);
        if (empty($privileges)) {
            return $temp;
        } 

        //两者权限进行对比
        foreach ($adminMenus as $menu) {
            if (empty($menu['url']) && $menu['pid'] == 0) {
                $temp[] = $menu;
            } else if(in_array($menu['url'],$privileges)) {
                $menu['url'] = str_replace('/index', '', $menu['url']);
                $temp[] = $menu;
            }
        }
        
        if (empty($temp)) {
            return $temp;
        }

        //生成菜单
        $temp = genTree($temp);
        session(['adminDetail.role_node' => json_encode($temp)]);
        session(['adminDetail.role_priviles' => json_encode($privileges)]);
        return $temp;
    }
}