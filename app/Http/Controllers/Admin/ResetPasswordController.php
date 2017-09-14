<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     *  重载重载密码页面模版
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        \Session::flash('info','请重置密码!');
        return view('admin.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * 获取重置密码期间所使用的broker.
     *
     * @return PasswordBroker
     * @translator laravelacademy.org
     */
    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * 自定义认证驱动 使用 admin guard  重载 AuthenticatesUsers 的 guard
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}