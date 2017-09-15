<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\PrivilegeCreateRequest;
use App\Http\Requests\PrivilegeUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PrivilegesRepository;

class PrivilegesController extends Controller
{
    protected $PrivilegesRpt;

    public function __construct(PrivilegesRepository $PrivilegesRpt)
    {
        $this->PrivilegesRpt = $PrivilegesRpt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.privilege.index');
        }else{
            $result = $this->PrivilegesRpt->handleSearch($request->all(),'privilege');
            return response()->json($result);            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.privilege.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivilegeCreateRequest $request)
    {
        if ($this->PrivilegesRpt->store($request->all())) {
            \Session::flash('success','添加成功!');
        }else{
            \Session::flash('warning','添加失败!');
        }

        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Privilege  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Privilege  $Privilege
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $privilege = $this->PrivilegesRpt->getById($id);
        return view('admin.privilege.edit')->with('privilege',$privilege);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Privilege  $Privilege
     * @return \Illuminate\Http\Response
     */
    public function update(PrivilegeUpdateRequest $request, $id)
    {
        if ($this->PrivilegesRpt->update($id,$request->all())) {
            \Session::flash('success','修改成功!');
        }else{
            \Session::flash('warning','修改失败!');
        }

        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Privilege  $Privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->PrivilegesRpt->destroy($id);
        \Session::flash('flash_notification_message','删除数据成功!');
        return  redirect()->back();
    }
}
