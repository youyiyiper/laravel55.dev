@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/manager/setting')}}">管理员设置</a></li>
            <li class="active">修改密码</li>
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
                        <h4 class="panel-title">修改密码</h4>
                    </div>

                    @include('layouts.flash')

                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/manager/postChangePwd') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">姓名:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="name" placeholder="姓名" value="{{ $name }}" data-parsley-required="true" data-parsley-required-message="请输入姓名" data-parsley-length="[2,20]" data-parsley-length-message="姓名长度2~20字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="password">密码 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="密码" value="" data-parsley-required="true" data-parsley-required-message="请输入密码" data-parsley-length="[6,20]" data-parsley-length-message="密码长度6~20字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="password_confirmation">确认密码 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="确认密码" value="" data-parsley-required="true" data-parsley-required-message="请确认密码" data-parsley-length="[6,20]" data-parsley-length-message="密码长度6~20字符" data-parsley-equalto="#password" data-parsley-equalto-message="两次密码输入不一致"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-6 col-sm-6">
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