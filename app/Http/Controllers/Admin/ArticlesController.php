<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Repositories\ArticlesRepository;
use App\Repositories\CategorysRepository;
use App\Repositories\TagsRepository;
use App\Repositories\ArticlesTagsRepository;

class ArticlesController extends Controller
{
    protected $ArticlesRpt;
    protected $CategorysRpt;
    protected $TagsRpt;
    protected $ArticlesTagsRpt;

    public function __construct(
        CategorysRepository $CategorysRpt,
        ArticlesRepository $ArticlesRpt,
        TagsRepository $TagsRpt,
        ArticlesTagsRepository $ArticlesTagsRpt
    )
    {
        $this->CategorysRpt = $CategorysRpt;
        $this->ArticlesRpt = $ArticlesRpt;
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
        $articles = $this->ArticlesRpt->getArticlesLists();
        return view('admin.article.index')->with(['articles' => $articles]);
    }

    /**
     * 图片上传
     *
     * @return string
     */
    public  function upload()
    {
        // path 为 public 下面目录，比如我的图片上传到 public/uploads 那么这个参数你传uploads 就行了
        $data = \EndaEditor::uploadImgFile('uploads/'.date('Ymd'));
        return json_encode($data);
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

        return view('admin.article.create')->with([
            'parentCategorys' => $parentCategorys,
            'tags' => $this->TagsRpt->getTagLists()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $res = $this->ArticlesRpt->createArticle($request->all());
        if ($res->id) {
            $this->ArticlesTagsRpt->createArticleTag($res->id,$request->tag);
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
        $article = $this->ArticlesRpt->getById($id);
        $article->content = \EndaEditor::MarkDecode($article->content);
        return view('admin.article.show')->with(['article' => $article]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentCategorys = $this->CategorysRpt->getOptionLists();
        $parentCategorys = noLimitCategory($parentCategorys);

        return view('admin.article.edit')->with([
            'article' => $this->ArticlesRpt->getById($id),
            'parentCategorys' => $parentCategorys,
            'tags' => $this->TagsRpt->getTagLists(),
            'tagArr' => $this->ArticlesTagsRpt->getTagIdArrByArticleId($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        if ($this->ArticlesRpt->updateArticle($id,$request->all())) {
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
        $this->ArticlesRpt->updateColumn($id,array('status' => -1));
        \Session::flash('flash_notification_message','删除数据成功!');

        return  redirect()->back();
    }
}
