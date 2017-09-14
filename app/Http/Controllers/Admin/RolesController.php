<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Repositories\PrivilegesRepository;
use App\Repositories\AdminsRolesRepository;

class RolesController extends Controller
{
    protected $RolesRpt;
    protected $PrivilegesRpt;
    protected $AdminsRolesRpt;

    public function __construct(
        RolesRepository $RolesRpt,
        PrivilegesRepository $PrivilegesRpt,
        AdminsRolesRepository $AdminsRolesRpt
    )
    {
        $this->RolesRpt = $RolesRpt;
        $this->PrivilegesRpt = $PrivilegesRpt;
        $this->AdminsRolesRpt = $AdminsRolesRpt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->RolesRpt->getRolesLists($status = 'all');
        return view('admin.role.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privileges = $this->PrivilegesRpt->getOptionPrivileges();
        $privileges = noLimitCategory($privileges);
        return view('admin.role.create')->with('privileges',$privileges);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $rules = [
            'name' => 'required|between:2,30|unique:roles',
            'desc' => 'required|between:2,20',
            'status' => 'between:0,1',
        ];

        $messsage = [
            'name.required' => '角色名称不能为空',
            'name.between'       => '角色名称必须是2~30位之间',
            'name.unique'       => '角色名称已经存在',
            'desc.required' => '角色描述不能为空',
            'desc.between'  => '角色描述必须是2~30位之间',
            'status.between'  => '状态错误',
        ];

        if ($request->has('permission')) {
            $rules['permission'] = 'required|array';
            $rules['permission.*'] = 'required|distinct|min:1';
            $messsage['permission.distinct'] = '权限不能重复';
        }        

        $this->validate(request(), $rules,$messsage);

        if ($this->RolesRpt->createRole($request->all())) {
            \Session::flash('success','添加成功!');
        }else{
            \Session::flash('warning','添加失败!');
        }

        return  redirect('admin/role/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->RolesRpt->getById($id);
        $rules = explode(',',$role->rules);
        $privileges = $this->PrivilegesRpt->getOptionPrivileges();
        $privileges = noLimitCategory($privileges);
        return view('admin.role.edit')->with(['role'=>$role,'privileges'=>$privileges,'rules' => $rules]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|between:2,30|unique:roles,name,'.$id.',id',
            'desc' => 'required|between:2,20',
            'status' => 'between:0,1',
        ];

        $messsage = [
            'name.required' => '角色名称不能为空',
            'name.between'       => '角色名称必须是2~30位之间',
            'name.unique'       => '角色名称已经存在',
            'desc.required' => '角色描述不能为空',
            'desc.between'  => '角色描述必须是2~30位之间',
            'status.between'  => '状态错误',
        ];

        if ($request->has('permission')) {
            $rules['permission'] = 'required|array';
            $rules['permission.*'] = 'required|distinct|min:1';
            $messsage['permission.distinct'] = '权限不能重复';
        }        

        $this->validate(request(), $rules,$messsage);
        
        if ($this->RolesRpt->updateRole($id,$request->all())) {
            \Session::flash('success','修改成功!');
        }else{
            \Session::flash('warning','修改失败!');
        }

        return  redirect('admin/role/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $res = $this->AdminsRolesRpt->checkRoleIsExist($id)) {
            $this->RolesRpt->destroy($id);
        } else {
            $this->RolesRpt->update($id,array('status' => -1));
        }

        \Session::flash('flash_notification_message','删除数据成功!');
        return  redirect('admin/role');
    }
}
