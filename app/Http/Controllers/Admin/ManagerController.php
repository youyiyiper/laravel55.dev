<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerChangePwdRequest;
use Illuminate\Http\Request;
use App\Repositories\AdminsRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * 管理员控制器
 */
class ManagerController extends Controller
{
    protected $AdminsRpt;

    public function __construct(
        AdminsRepository $AdminsRpt
    )
    {
        $this->AdminsRpt = $AdminsRpt;
    }

	/**
	 * 修改密码 显示修改密码页面
	 */
    public function changePwd()
    {    	
    	$name = session('adminDetail.name');
        return view('admin.manager.changePwd')->with('name',$name);
    }

    /**
     * 修改密码 显示修改密码页面
     */
    public function postChangePwd(ManagerChangePwdRequest $request)
    {
        $admin_id = session('adminDetail.id');
        $result = $this->AdminsRpt->update($admin_id,array('password' => bcrypt($request->password)));
        if ($result) {
            \Session::flash('success','修改成功!');
        }else{
            \Session::flash('warning','修改失败!');
        }

        return redirect('admin/manager/changePwd');
    }    

	/**
	 * 信息设置
	 */
    public function setting(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.manager.setting'); 
        }else{
            $rules = [
                'headimg' => 'required',
            ];

            $messages = [
                'headimg.required'     => '图片不能为空',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return Response::json([
                    'code' => 1,
                    'msg' => $validator->messages()->first(),
                ], 200);
            }

            $admin_id = session('adminDetail.id');
            $headimg = str_replace(env('APP_URL').'/', '', $request->headimg);
            $result = $this->AdminsRpt->updateColumn($admin_id,array('headimg' => $headimg));
            if( !$result) {
                \Session::flash('warning','修改失败!');
                return Response::json([
                    'code' => 1,
                    'msg' => '修改失败',
                ], 200);
            }

            \Session::flash('success','修改成功!');
            session(['adminDetail.headimg' => $headimg]);
            return Response::json([
                'code' => 0,
                'msg' => '',
            ], 200);         
        }      
    }    
}
