<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //后台用户登录后跳转
    protected $redirectTo = '/admin/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 后台登录页面
     */
    public function index($type = '')
    {
        return view('admin.login'.$type);
    }

    /**
     * 后台退出  
     * 重载 AuthenticatesUsers 的 logout
     */
    public function logout()
    {
        auth('admin')->logout();
        session()->flush();
        return redirect('admin/login');
    }

    /**
     * 自定义认证驱动 使用 admin guard  重载 AuthenticatesUsers 的 guard
     * 
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
