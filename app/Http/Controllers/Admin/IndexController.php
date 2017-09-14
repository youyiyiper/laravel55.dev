<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
 * 后台首页控制器
 */
class IndexController extends Controller
{
    /**
     * 首页展示
     */
    public function index(Request $request)
    {
        return view('admin.index');
    }
}