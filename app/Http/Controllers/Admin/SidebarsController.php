<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SidebarsRepository;

class SidebarsController extends Controller
{
    protected $SidebarsRepository;

    public function __construct(SidebarsRepository $SidebarsRepository)
    {
        $this->SidebarsRepository = $SidebarsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sidebars = $this->SidebarsRepository->getAllSidebar();
        $sidebars = noLimitCategory($sidebars);
        return view('admin.sidebar.index',compact('sidebars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentSidebar = $this->SidebarsRepository->getOptionSidebar();
        $parentSidebar = noLimitCategory($parentSidebar);
        return view('admin.sidebar.create',compact('parentSidebar'));
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
            'name' => 'required|between:2,30|unique:sidebars',
        ];

        $messsage = [
            'name.required'     => '菜单名称不能为空',
            'name.between'      => '菜单名称必须是2~30位之间',
            'name.unique'       => '菜单名称已经存在',
        ];

        if ($request->has('url')) {
            $rules['url.between'] = 'between:2,50';
            $messsage['url.between'] = '菜单链接必须是2~50位之间';
        }        

        if ($request->has('purview_flag')) {
            $rules['purview_flag.between'] = 'between:2,50';
            $messsage['purview_flag.between'] = '菜单权限标识必须是2~50位之间';
        }

        if ($request->has('class')) {
            $rules['class.between'] = 'between:2,30';
            $messsage['class.between'] = '菜单图标必须是2~30位之间';
        } 

        $this->validate(request(), $rules,$messsage);

        if ($this->SidebarsRepository->createSidebar($request->all())) {
            \Session::flash('success','添加成功!');
        }else{
            \Session::flash('warning','添加失败!');
        }

        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentSidebar = $this->SidebarsRepository->getOptionSidebar();
        $parentSidebar = noLimitCategory($parentSidebar);
        $sidebar = $this->SidebarsRepository->getSidebar($id);
        return view('admin.sidebar.edit',compact('parentSidebar','sidebar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|between:2,30|unique:sidebars,name,'.$id.',id',
        ];

        $messsage = [
            'name.required'     => '菜单名称不能为空',
            'name.between'      => '菜单名称必须是2~30位之间',
            'name.unique'       => '菜单名称已经存在',
        ];

        if ($request->has('url')) {
            $rules['url.between'] = 'between:2,50';
            $messsage['url.between'] = '菜单链接必须是2~50位之间';
        }        

        if ($request->has('purview_flag')) {
            $rules['purview_flag.between'] = 'between:2,50|unique:sidebars,purview_flag,'.$id.',id';
            $messsage['purview_flag.between'] = '菜单权限标识必须是2~50位之间';
            $messsage['purview_flag.unique'] = '权限标识已经存在';
        }

        if ($request->has('class')) {
            $rules['class.between'] = 'between:2,30';
            $messsage['class.between'] = '菜单图标必须是2~30位之间';
        } 

        $this->validate(request(), $rules,$messsage);
        
        if ($this->SidebarsRepository->updateSidebar($id,$request->all())) {
            \Session::flash('success','修改成功!');
        }else{
            \Session::flash('warning','修改失败!');
        }

        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->SidebarsRepository->delete($id);
  
        if ($result) {
            \Session::flash('flash_notification_message','删除数据成功!');
        }else{
            \Session::flash('flash_notification_message','删除数据失败!');
        }

        return  redirect()->back();
    }
}
