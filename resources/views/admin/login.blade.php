@extends('admin.layouts.login')
@section('admin-auth-page-container')
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <span class="logo"></span> Color Admin
            <small><a href="{{ url('admin/login/1') }}">切换登录页面? </a></small>
        </div>
        <div class="icon">
            <i class="fa fa-sign-in"></i>
        </div>
    </div>   
    <!-- end brand -->
     
    <div class="login-content">
        @include('layouts.flash')
        <form action="{{ url('admin/login') }}" method="POST" class="margin-bottom-0">
            {{ csrf_field() }}
            <div class="form-group m-b-20">
                <input type="text" name="email" class="form-control input-lg" placeholder="邮箱" value="{{ old('email') }}"/>
            </div>
            <div class="form-group m-b-20">
                <input type="password" name="password" class="form-control input-lg" placeholder="密码" />
            </div>
            <div class="checkbox m-b-20">
                <label>
                    <input name="remember" type="checkbox" /> 记住密码
                </label>
            </div>
            <div class="login-buttons">
                <button type="submit" class="btn btn-success btn-block btn-lg">登 录</button>
            </div>
            <div class="m-t-20">
                <a href="{{ url('admin/password/email') }}">忘记密码? </a>
            </div>
        </form>
    </div>
@endsection
