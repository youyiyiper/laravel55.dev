<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $redirectTo = '/admin/email';

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
     * 显示发送邮件视图
     * 重载 SendsPasswordResetEmails 的 showLinkRequestForm
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * 执行发送邮件
     * 重载 SendsPasswordResetEmails 的 sendResetLinkEmail
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        //验证邮箱地址是否有效
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // 发送邮件  sendResetLink是PasswordBroker 里面的一个方法
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        //根据发送邮件返回状态 返回相应
        if($response == Password::RESET_LINK_SENT){
            \Session::flash('success','邮件发送成功!');
            return $this->sendResetLinkResponse($response);
        }else{
            \Session::flash('warning','邮件发送失败!');
            return $this->sendResetLinkFailedResponse($request, $response);
        }
    }

    /**
     * 获取密码重置期间所使用的broker.
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
     * 
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
