<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class RabcMiddleware
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
        $admin_id = auth('admin')->user()->id;
        if ( $admin_id < 1) {
            return abort(500,'您没有权限进行此次操作！');
        }

        //App\Http\Controllers\Admin\ManagerController@changePwd
        $route = Route::currentRouteAction();
        $route = explode('\\',$route);
        $end_route = end($route);
        if (strpos($end_route,'@') === false) {
            return abort(500,'您没有权限进行此次操作！');
        } else {
            $end_route = explode('@',$end_route);
            $controller_name = strtolower(str_replace('Controller','',$end_route[0]));
            $action_name = strtolower($end_route[1]);
            //检查管理员用户是否有权限
            if (!$this->checkIsHadPermission($admin_id,$controller_name,$action_name)) {
                return abort(500,'您没有权限进行此次操作！');
            }
        }

        return $next($request);
    }

    /**
     * 检查用户是否有权限
     * 
     * @param  int    $admin_id         后台用户id：
     * @param  string $controller_name  方法名称：
     * @param  string $action_name      方法名称：
     * @return bool                    
     */
    public function checkIsHadPermission($admin_id,$controller_name,$action_name)
    {
        return true;
    }
}
