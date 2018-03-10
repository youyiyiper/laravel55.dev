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
        //App\Http\Controllers\Admin\ManagerController@changePwd
        $route = Route::currentRouteAction();
        $route = explode('\\',$route);
        $end_route = end($route);
        if (strpos($end_route,'@') === false) {
            return abort(500,'您没有权限进行此次操作！');
        }

        //获取控制器名称和方法名称
        $end_route = explode('@',$end_route);
        $controller_name = strtolower(str_replace('Controller','',$end_route[0]));
        $action_name = strtolower($end_route[1]);
        //检查管理员用户是否有权限
        if (!$this->checkIsHadPermission($controller_name,$action_name)) {
            return abort(500,'您没有权限进行此次操作！');
        }

        return $next($request);
    }

    /**
     * 检查用户是否有权限
     * 
     * @param  string $controller_name  方法名称：
     * @param  string $action_name      方法名称：
     * @return bool                    
     */
    public function checkIsHadPermission($controller_name,$action_name)
    {
        //获取角色拥有的权限
        $role_priviles = session('adminDetail.role_priviles');
        if(empty($role_priviles)){
            return false;
        }

        //判断当前节点是否有权限
        $role_priviles = json_decode($role_priviles,true);
        $node = 'admin/'.rtrim($controller_name,'s').'/'.$action_name;
        if(!in_array($node,$role_priviles)){
            return false;
        }
        return true;
    }
}
