@extends('admin.layouts.master')

@section('admin-css')
	<style type="text/css">
		.article_show pre{
			background: #2D353C;
		}
		.article_show pre code{
			color: #fff;
		}		
	</style>
@endsection

@section('admin-content')
    <div id="content" class="content">
         <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/article')}}">文章列表</a></li>
            <li class="active">文章详情</li>
        </ol>
        <!-- end breadcrumb -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        @include('admin.layouts.panel-btn')
                        <h4 class="panel-title">{{$article->title}}</h4>
                    </div>
                    <div class="panel-body article_show">
                        {!!$article->content!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection