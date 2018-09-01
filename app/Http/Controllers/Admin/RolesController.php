<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
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
    public function store(RoleCreateRequest $request)
    {
        if ($this->RolesRpt->createRole($request->all())) {
            \Session::flash('success','添加成功!');
        }else{
            \Session::flash('warning','添加失败!');
        }

        return  redirect()->back();
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
    public function update(RoleUpdateRequest $request, $id)
    {
        if ($this->RolesRpt->updateRole($id,$request->all())) {
            \Session::flash('success','修改成功!');
        }else{
            \Session::flash('warning','修改失败!');
        }

        return  redirect()->back();
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
        return  redirect()->back();
    }
}
