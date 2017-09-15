<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\AdminsRepository;
use App\Repositories\RolesRepository;
use App\Repositories\AdminsRolesRepository;

class AdminsController extends Controller
{
    protected $AdminsRpt;
    protected $RolesRpt;
    protected $AdminsRolesRpt;

    public function __construct(
        AdminsRepository $AdminsRpt,
        RolesRepository $RolesRpt,
        AdminsRolesRepository $AdminsRolesRpt
    )
    {
        $this->AdminsRpt = $AdminsRpt;
        $this->RolesRpt = $RolesRpt;
        $this->AdminsRolesRpt = $AdminsRolesRpt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->AdminsRpt->getAdminLists();
        return view('admin.admin.index')->with('admins',$admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = $this->RolesRpt->getRolesLists($status = 1);
        return view('admin.admin.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {
        if ($this->AdminsRpt->handleCreateAdmin($request->all())) {
            \Session::flash('success','创建成功!');
        } else {
            \Session::flash('warning','创建失败!');
        }

        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $id 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = $this->AdminsRpt->getById($id);
        $adminsRoles = $this->AdminsRolesRpt->getByAdminId($id);
        $roles = $this->RolesRpt->getRolesLists($status = 1);

        return view('admin.admin.edit')->with(
            [
                'roles' => $roles,
                'admin' => $admin,
                'adminsRoles' => $adminsRoles
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $id 
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        if ($this->AdminsRpt->handleUpdateAdmin($id,$request->all())) {
            \Session::flash('success','修改成功!');
        } else {
            \Session::flash('warning','修改失败!');
        }

        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->AdminsRpt->update($id,array('status' => 0));
        $this->AdminsRolesRpt->deleteByWhere(array('admin_id' => $id));
        \Session::flash('flash_notification_message','删除成功!');
        return  redirect()->back();
    }
}
