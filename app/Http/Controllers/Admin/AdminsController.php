<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:admins',
            'name' => 'required|between:2,20',
            'password' => 'required|confirmed|between:6,20',
            'role_id' => 'required|min:1',
        ];

        $messsages = [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',
            'name.required'       => '名称不能为空',
            'name.between'       => '名称必须是2~30位之间',
            'password.required' => '密码不能为空',
            'password.between'  => '密码必须是6~20位之间',
            'password.confirmed' => '新密码和确认密码不匹配',
            'role_id.required'  => '角色必须',
        ];

        $this->validate(request(), $rules,$messsages);

        if ($this->AdminsRpt->handleCreateAdmin($request->all())) {
            \Session::flash('success','创建成功!');
        } else {
            \Session::flash('warning','创建失败!');
        }

        return  redirect('admin/admin/create');
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
    public function update(Request $request, $id)
    {
        $rules = [
            'email' => 'required|email|unique:admins,name,'.$id,',id',
            'name' => 'required|between:2,20'
        ];

        $messsage = [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',
            'name.required'       => '名称不能为空',
            'name.between'       => '名称必须是2~20位之间'
        ];

        if ($request->has('password')) {
            $rules['password'] = 'required|confirmed|between:6,20';
            $messsage['permission.required'] = '密码不能为空';
            $messsage['permission.between'] = '密码必须是6~20位之间';
            $messsage['permission.confirmed'] = '新密码和确认密码不匹配';
        }
            
        $this->validate(request(), $rules,$messsage);

        if ($this->AdminsRpt->handleUpdateAdmin($id,$request->all())) {
            \Session::flash('success','修改成功!');
        } else {
            \Session::flash('warning','修改失败!');
        }

        return  redirect('admin/admin/'.$id.'/edit');
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
        return  redirect('admin/admin');
    }
}
