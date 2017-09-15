<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CategorysRepository;
use App\Repositories\ArticlesRepository;

class CategorysController extends Controller
{
    protected $CategorysRpt;
    protected $ArticlesRpt;

    public function __construct(
        CategorysRepository $CategorysRpt,
        ArticlesRepository $ArticlesRpt
    )
    {
        $this->CategorysRpt = $CategorysRpt;
        $this->ArticlesRpt = $ArticlesRpt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = $this->CategorysRpt->getCategorysLists();
        return view('admin.category.index')->with('categorys',$categorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategorys = $this->CategorysRpt->getOptionLists();
        $parentCategorys = noLimitCategory($parentCategorys);
        return view('admin.category.create')->with('parentCategorys',$parentCategorys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        if ($this->CategorysRpt->createCategory($request->all())) {
            \Session::flash('success','添加成功!');
        } else {
            \Session::flash('warning','添加失败!');
        }

        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->CategorysRpt->getById($id);
        $parentCategorys = $this->CategorysRpt->getOptionLists();
        $parentCategorys = noLimitCategory($parentCategorys);
        return view('admin.category.edit')->with(['category' => $category,'parentCategorys'=>$parentCategorys]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        if ($this->CategorysRpt->updateCategory($id,$request->all())) {
            \Session::flash('success','修改成功!');
        } else {
            \Session::flash('warning','修改失败!');
        }

        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->ArticlesRpt->checkCategoryIsUsed($id)) {
            $this->CategorysRpt->updateColumn($id,array('status' => 0));
        } else {
            $this->CategorysRpt->destroy($id);
        }

        \Session::flash('flash_notification_message','删除数据成功!');
        return  redirect()->back();
    }
}
