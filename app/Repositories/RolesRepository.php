<?php

namespace App\Repositories;

use App\Models\Role;

class RolesRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Role $Role)
    {
        $this->model = $Role;
    }

    /**
     * 获取角色列表
     * 
     * @param  integer $status 1正常，0删除 all 全部
     * @return array
     */
    public function getRolesLists($status = 1)
    {
        if ($status == 'all') {
            return $this->model->where('status','>',-1)->latest()->paginate(20);
        } else {
            return $this->model->where('status',$status)->latest()->get();
        }
    }

    /**
     * 通过角色id获取权限规则
     *
     * @param  integer $role_id 角色id
     * @return string 
     */
    public function getRulesByRoleId($role_id)
    {
        return $this->model->where([
            ['id','=',$role_id],
            ['status','>',0]
        ])->pluck('rules')->first();
    }

    /**
     * 添加角色
     * 
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function createRole($post)
    {
        $input['name'] = $post['name'];
        $input['desc'] = $post['desc'];
        $input['status'] = !empty($post['status']) ? 1 : 0;
        $input['rules'] = !empty($post['permission']) ? implode(',',$post['permission']) : '';

        return $this->store($input);
    }

    /**
     * 修改角色
     * 
     * @param  [type] $id   [description]
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public function updateRole($id,$post)
    {
        $input['name'] = $post['name'];
        $input['desc'] = $post['desc'];
        $input['status'] = !empty($post['status']) ? 1 : 0;
        $input['rules'] = !empty($post['permission']) ? implode(',',$post['permission']) : '';
        return $this->update($id,$input);
    }
}
