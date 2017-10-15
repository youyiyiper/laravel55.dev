<?php

namespace App\Repositories;

use App\Admin;

class AdminsRepository
{
    use BaseRepository;

    protected $model;
    protected $AdminsRolesRpt;

    public function __construct(Admin $Admin,AdminsRolesRepository $AdminsRolesRpt)
    {
        $this->model = $Admin;
        $this->AdminsRolesRpt = $AdminsRolesRpt;
    }

    /**
     * 检查角色是否存在
     * 
     * @param  int $role_id 角色id
     * @return bool         
     */
    public function getAdminLists()
    {
        return $this->model
            ->where('admins.status','=','1')
            ->orderBy('admins.created_at','desc')
            ->select(['admins.id','admins.name','admins.email','admins.created_at','admins.updated_at','roles.name as role_name'])
             
            ->leftJoin('admins_roles', 'admins_roles.admin_id', '=', 'admins.id')
            ->leftJoin('roles', 'roles.id', '=', 'admins_roles.role_id')
            ->paginate(15);
    }

    /**
     * 执行创建后台用户
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function handleCreateAdmin($post)
    {
        $admin = $this->createAdmin($post);
        if (!empty($admin->id)) {
            $admin_id = $admin->id;
            $role_id = !empty($post['role_id']) ? $post['role_id'] : 0;
            $this->AdminsRolesRpt->createAdminRole($admin_id,$role_id);
        }
        return $admin;
    }

    /**
     * 创建后台用户
     * 
     * @return [type] [description]
     */
    public function createAdmin($post)
    {
        $input = [];
        $input['name'] = $post['name'];
        $input['email'] = $post['email'];
        $input['password'] = bcrypt($post['password']);
        return  $this->store($input);
    }

    /**
     * 执行修改后台用户
     *
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function handleUpdateAdmin($admin_id,$post)
    {
        $res = $this->updateAdmin($admin_id,$post);
        if ($res) {
            $role_id = !empty($post['role_id']) ? $post['role_id'] : 0;
            $admin = $this->AdminsRolesRpt->getByAdminId($admin_id);
            if($admin){
                $this->AdminsRolesRpt->updateAdminRole($admin_id,$role_id);
            }else{
                $this->AdminsRolesRpt->createAdminRole($admin_id,$role_id);
            }
        }

        return $res;
    }

    /**
     * 创建后台用户
     * 
     * @return [type] [description]
     */
    public function updateAdmin($id,$post)
    {
        $input = [];
        $input['name'] = $post['name'];
        if (!empty($post['password'])) {
            $input['password'] = bcrypt($post['password']);
        }
        
        return  $this->update($id,$input);
    }
}
