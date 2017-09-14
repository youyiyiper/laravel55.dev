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
            <li><a href="{{url('admin/admin')}}">管理员列表</a></li>
            <li class="active">修改管理员</li>         
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
                        <h4 class="panel-title">修改管理员</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/admin/'.$admin->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="email">邮箱 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="email" placeholder="邮箱（将会作为登录名）" data-parsley-required="true" data-parsley-required-message="请输入邮箱" value="{{ $admin->email }}" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="name">姓名 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="name" placeholder="姓名" data-parsley-length="[2,20]" data-parsley-length-message="姓名长度2~20字符" data-parsley-required="true" data-parsley-required-message="请输入姓名" value="{{ $admin->name }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="password">新密码 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" id="password" type="text" name="password" placeholder="密码" data-parsley-length="[6,20]" data-parsley-length-message="密码长度6~20字符" value="{{ old('password') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="password">确认密码 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="password_confirmation" placeholder="确认密码" data-parsley-length="[6,20]" data-parsley-length-message="密码长度6~20字符" data-parsley-equalto="#password" data-parsley-equalto-message="两次密码输入不一致" value="{{ old('password_confirmation') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="role">选择角色 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#role_error"
                                            data-parsley-required-message="请选择角色"
                                            name="role_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($roles as $key=>$value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == $adminsRoles['role_id']) selected="selected" @endif>{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="role_error"></p>
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