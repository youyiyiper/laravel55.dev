<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;

class RedisController extends Controller
{
    public function index()
    {
    	$redis = Redis::connection();
    	#$redis = Redis::connection('slave');
    	$redis->set('bb','444');
    	$res = $redis->get('bb');
    	dd($res);;
    }
}
