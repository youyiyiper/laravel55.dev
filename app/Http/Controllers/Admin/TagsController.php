<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Repositories\TagsRepository;
use App\Repositories\ArticlesTagsRepository;

class TagsController extends Controller
{
    protected $TagsRpt;
    protected $ArticlesTagsRpt;

    public function __construct(
        TagsRepository $TagsRpt,
        ArticlesTagsRepository $ArticlesTagsRpt
    )
    {
       $this->TagsRpt = $TagsRpt;
       $this->ArticlesTagsRpt = $ArticlesTagsRpt;
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tags = $this->TagsRpt->getTagLists();
        return view('admin.tag.index')->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        if ($this->TagsRpt->createTag($request->all())) {
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
        $tag = $this->TagsRpt->getById($id);
        return view('admin.tag.edit')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        if ($this->TagsRpt->updateTag($id,$request->all())) {
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
        if (!$this->ArticlesTagsRpt->checkTagsIsUsed($id)) {
            \Session::flash('flash_notification_message','删除数据失败,标签已经被使用!');
        } else {
            $this->TagsRpt->destroy($id);
            \Session::flash('flash_notification_message','删除数据成功!');
        }
        
        return  redirect()->back();
    }
}
