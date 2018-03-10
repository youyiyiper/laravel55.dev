<?php

namespace App\Repositories;

use App\Privilege;

class PrivilegesRepository
{
    use BaseRepository;

    protected $model;
    protected $SearchRpt;

    public function __construct(
        Privilege $Privilege,
        SearchRepository $SearchRpt
    )
    {
        $this->model = $Privilege;
        $this->SearchRpt = $SearchRpt;
    }

    /**
     * 获取权限列表
     * 
     * @return [type] [description]
     */
    public function getOptionPrivileges()
    {
        return $this->model->orderBy('name','desc')->select(['id','name','pid'])->get()->toArray();
    }

    /**
     * 处理搜索
     * 
     * @return [type] [description]
     */
    public function handleSearch($request,$route)
    {
        return $this->SearchRpt->handleSearch($request,$route,$this->model);
    }

    /**
     * 通过角色拥有的规则获取权限列表
     *
     * @param string $rules 角色拥有的规则
     * @return array 权限列表
     */
    public function getPrivilegesByRules($rules){
        $rules = explode(',', $rules);
        $res = $this->model->select('flag')->whereIn('id', $rules)->get();
        $temp = array();
        if($res){
            foreach ($res as $value) {
                $temp[] = $value['flag'];
            }            
        }
        return $temp;
    }
}
