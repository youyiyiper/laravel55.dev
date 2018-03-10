@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/privilege')}}">权限列表</a></li>
            <li class="active">修改权限</li>         
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
                        <h4 class="panel-title">修改权限</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/privilege/'.$privilege->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="name">权限名称 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="name" placeholder="权限名称" value="{{ $privilege->name }}" data-parsley-required="true" data-parsley-required-message="请输入名称" data-parsley-length="[2,30]" data-parsley-length-message="名称长度2~30字符" />
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="flag">权限标识 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="flag" placeholder="权限标识" value="{{ $privilege->flag }}" data-parsley-required="true" data-parsley-required-message="请输入权限" data-parsley-length="[2,50]" data-parsley-length-message="权限长度2~50字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="desc">权限描述 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="desc" placeholder="权限描述" value="{{ $privilege->desc }}" data-parsley-required="true" data-parsley-required-message="请输入权限描述" data-parsley-length="[2,50]" data-parsley-length-message="权限描述长度2~50字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="pid">上级权限 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_id_error"
                                            data-parsley-required-message="请选择上级权限"
                                            name="pid">
                                        <option value="0">-- 顶级权限 --</option>
                                        @foreach($parentPrivilege as $value)
                                            @if($value['id'] != $privilege->id)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == $privilege->pid) selected="selected" @endif>{{ str_repeat('&nbsp;',$value['level'] * 4) }} {{ $value['name'] }}</option>
                                            @endif
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
@endsection