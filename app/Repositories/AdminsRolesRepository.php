<?php

namespace App\Repositories;

use App\AdminsRole;

class AdminsRolesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(AdminsRole $AdminsRole)
    {
        $this->model = $AdminsRole;
    }

    /**
     * 检查角色是否存在
     * 通过role_id 获取admin_role记录
     * 
     * @param  int $role_id 角色id
     * @return bool         
     */
    public function checkRoleIsExist($role_id)
    {
        return $this->model->where('role_id',$role_id)->take(1)->first();
    }

    /**
     * 通过admin_id 获取admin_role记录
     * 
     * @param  [type] $admin_id [description]
     * @return [type]           [description]
     */
    public function getByAdminId($admin_id)
    {
        return $this->model->where('admin_id',$admin_id)->take(1)->first();
    }

    /**
     * 创建admin角色
     * 
     * @param  [type] $admin_id [description]
     * @param  [type] $role_id  [description]
     * @return [type]           [description]
     */
    public function createAdminRole($admin_id,$role_id)
    {
        return $this->store(array('admin_id' => $admin_id,'role_id' => $role_id));
    }

    /**
     * 修改admin角色
     * 
     * @param  [type] $admin_id [description]
     * @param  [type] $role_id  [description]
     * @return [type]           [description]
     */
    public function updateAdminRole($admin_id,$role_id)
    {
        return $this->model->where('admin_id', $admin_id)->update(['role_id' => $role_id]);  
    }
}
