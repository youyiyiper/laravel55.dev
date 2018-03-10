<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    //登录页面 可切换
    Route::get('login/{type?}', 'LoginController@index');
    //登录提交
    Route::post('login','LoginController@login');

    //忘记密码 填写邮箱
    Route::get('password/email','ForgotPasswordController@showLinkRequestForm');
    //忘记密码 提交邮箱
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');

    //打开邮箱负责地址跳转验证
    Route::get('password/reset/{token?}','ResetPasswordController@showResetForm');
    Route::post('password/reset','ResetPasswordController@reset');

    //登录后 用中间件auth.admin 来验证登录状态
    Route::group(['middleware' => 'auth.admin'], function () {
        //首页
        Route::get('/', 'IndexController@index');
        Route::get('/index', 'IndexController@index');

        //退出
        Route::get('logout', 'LoginController@logout');

        //用中间件rabc.check 来验证是否有权限操作
        Route::group(['middleware' => 'rabc.check'], function () {

            //修改密码
            Route::get('manager/changePwd','ManagerController@changePwd');
            Route::post('manager/postChangePwd','ManagerController@postChangePwd');

            //信息中心
            Route::get('manager/setting','ManagerController@setting');
            Route::post('crop/upload','CropController@upload');
            Route::post('crop/handle','CropController@handle');

            //角色
            Route::resource('role', 'RolesController');
            //权限
            Route::resource('privilege', 'PrivilegesController');
            //菜单
            Route::resource('sidebar', 'SidebarsController');
           
            //配置
            Route::resource('config', 'ConfigsController');
            //后台用户
            Route::resource('admin', 'AdminsController');
            //文章分类
            Route::resource('category', 'CategorysController');
            //文章
            Route::resource('article', 'ArticlesController');
            Route::post('article/upload','ArticlesController@upload');
            //标签
            Route::resource('tag', 'TagsController');
        });
    });
});