<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * 后台用户登录中间件
 */
class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //如：$guard为admin
        if (Auth::guard('admin')->guest()) {
            //判断是否ajax
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }

        //设置管理员session
        $this->setAdminSession();

        return $next($request);
    }

    /**
     * 设置管理员session
     */
    public function setAdminSession()
    {
        if (!session('adminDetail')) {
            $adminDetail = auth('admin')->user()->toArray();

            if (!$adminDetail) {
                return redirect()->guest('admin/login');
            } else {
                foreach ($adminDetail as $key => $value) {
                    session(['adminDetail.'.$key => $value]);
                }

                return true;
            }
        }

        return false;
    }
}
