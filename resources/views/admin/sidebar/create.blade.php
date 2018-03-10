@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/sidebar')}}">菜单列表</a></li>
            <li class="active">新增菜单</li>         
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
                        <h4 class="panel-title">新增菜单</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/sidebar') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="name">菜单名称 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="name" placeholder="菜单名称" value="{{ old('name') }}" data-parsley-required="true" data-parsley-required-message="请输入菜单名称" data-parsley-length="[2,30]" data-parsley-length-message="角色名称长度2~30字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="url">菜单链接:</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="url" placeholder="菜单链接" value="{{ old('url') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="class">菜单图标 :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="class" placeholder="菜单图标" value="{{ old('class') }}" />
                                    <p style="line-height: 25px;height:25px;"><a href="http://www.bootcss.com/p/font-awesome/" target="_blank" >http://www.bootcss.com/p/font-awesome/</a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="pid">上级菜单 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_id_error"
                                            data-parsley-required-message="请选择上级菜单"
                                            name="pid">
                                        <option value="0">-- 顶级菜单 --</option>
                                        @foreach($parentSidebar as $sidebar)
                                        <option value="{{ $sidebar->id }}">{{ str_repeat('&nbsp;',$sidebar->level * 4) }}{{ $sidebar->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="parent_id_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2"></label>
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
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('render');
    </script>
@endsection