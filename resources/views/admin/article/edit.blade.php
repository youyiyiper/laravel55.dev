@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/article')}}">文章列表</a></li>
            <li class="active">修改文章</li>
        </ol>
        <!-- end breadcrumb -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        @include('admin.layouts.panel-btn')
                        <h4 class="panel-title">修改文章</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/article') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="title">标题 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="title" placeholder="标题" value="{{ $article->title }}" data-parsley-required="true" data-parsley-required-message="请输入文章标题" data-parsley-length="[2,50]" data-parsley-length-message="文章标题长度2~50字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="desc">描述 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="desc" placeholder="描述"  value="{{ $article->desc }}" data-parsley-required="true" data-parsley-required-message="请输入文章描述" data-parsley-length="[2,120]" data-parsley-length-message="文章描述名称长度2~120字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="is_top">置顶 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input type="checkbox" name="is_top" data-render="switchery" data-theme="purple" value="{{$article->is_top}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="category_id">分类 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control" name="category_id">
                                        <option value="">请选择</option>
                                        @foreach($parentCategorys as $value)
                                            <option value="{{$value['id']}}" @if($value['category_id'] == $article->category_id) selected="selected" @endif>{{$value['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="status">标签 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control select2" name="tag[]" multiple="multiple">
                                        @foreach($tags as $value)
                                            <option value="{{$value['id']}}" @if(in_array($value['id'],$tagArr)) selected="selected" @endif >{{$value['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1" for="content">内容 * :</label>
                                <div class="col-md-11 col-sm-11">
                                    @include('vendor.editor.head')
                                    <div class="editor">
                                        <textarea id='myEditor' name="content">{{$article->content}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1"></label>
                                <div class="col-md-4 col-sm-4">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/select2/dist/js/select2.min.js')}}"></script>
    <script>

        $('.select2').select2({
            placeholder:'请选择',
            allowClear:true
        });

        $(document).ready(function() {
            renderSwitcher();
        });

        function renderSwitcher(){
            if ($('[data-render=switchery]').length !== 0) {
                $('[data-render=switchery]').each(function() {
                    var themeColor = '#00acac';
                    if ($(this).attr('data-theme')) {
                        switch ($(this).attr('data-theme')) {
                            case 'red': themeColor = '#ff5b57'; break;
                            case 'blue': themeColor = '#348fe2'; break;
                            case 'purple': themeColor = '#727cb6'; break;
                            case 'orange': themeColor = '#f59c1a'; break;
                            case 'black': themeColor = '#2d353c'; break;
                        }
                    }
                    var option = {};
                    option.color = themeColor;
                    option.secondaryColor = ($(this).attr('data-secondary-color')) ? $(this).attr('data-secondary-color') : '#dfdfdf';
                    option.className = ($(this).attr('data-classname')) ? $(this).attr('data-classname') : 'switchery';
                    option.disabled = ($(this).attr('data-disabled')) ? true : false;
                    option.disabledOpacity = ($(this).attr('data-disabled-opacity')) ? parseFloat($(this).attr('data-disabled-opacity')) : 0.5;
                    option.speed = ($(this).attr('data-speed')) ? $(this).attr('data-speed') : '0.3s';
                    var switchery = new Switchery(this, option);
                });
            }
        }
    </script>
@endsection