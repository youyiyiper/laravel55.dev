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
}
