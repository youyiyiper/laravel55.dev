@extends('admin.layouts.login')
@section('admin-auth-page-container')
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <span class="logo"></span> 重置密码
        </div>
        <div class="icon">
            <i class="fa fa-sign-in"></i>
        </div>
    </div>   
    <!-- end brand -->    
    <div class="login-content">
        @include('layouts.flash')
        <form action="{{ url('admin/password/reset') }}" method="POST" class="margin-bottom-0">
            {{ csrf_field() }}
            <div class="form-group m-b-20">
                <input type="text" name="email" class="form-control input-lg" placeholder="邮箱" value="{{ old('email') }}"/>
            </div>
            <div class="form-group m-b-20">
                <input type="password" name="password" class="form-control input-lg" placeholder="密码" />
            </div>
            <div class="form-group m-b-20">
                <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="确认密码" />
            </div> 
            <div class="form-group m-b-20">
                
            </div>                    
            <div class="login-buttons">
                <input type="hidden" name="token" value="{{$token}}"/>
                <button type="submit" class="btn btn-success btn-block btn-lg">重置密码</button>
            </div>
        </form>
    </div>
@endsection