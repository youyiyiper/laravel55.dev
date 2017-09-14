@extends('admin.layouts.login')
@section('admin-auth-page-container')
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <span class="logo"></span> 填写邮箱
        </div>
        <div class="icon">
            <i class="fa fa-sign-in"></i>
        </div>
    </div>   
    <!-- end brand -->
     
    <div class="login-content">
        @include('layouts.flash')
        <form action="{{ url('admin/password/email') }}" method="POST" class="margin-bottom-0">
            {{ csrf_field() }}
            <div class="form-group m-b-20">
                <input type="text" name="email" class="form-control input-lg" placeholder="邮箱" value="{{ old('email') }}"/>
            </div>

            <div class="login-buttons">
                <button type="submit" class="btn btn-success btn-block btn-lg">发送邮件</button>
            </div>
            <div class="m-t-20">
                <a href="{{ url('admin/login') }}">返回登录</a>
            </div>
        </form>
    </div>
@endsection