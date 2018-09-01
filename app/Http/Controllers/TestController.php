<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function upload()
    {
    	return view('test');
    }

    public function doUpload(Request $request){     
        if ($request->hasFile('upload')) {
		    $files =  $request->file('upload');
		    $path = '/public/uploads/'.date('Ymd');
	        if($files){
	            foreach ($files as $file) {
	            	$extension = $file->getClientOriginalExtension();
	            	$newName = str_random(18).".".$extension;
	            	$file -> move(base_path().$path,$newName);
	            	return json_encode(array('code' => 0,'data' => $path.$newName));
	            }
	        }else{
	            return json_encode(array('code' => 100,'err' => '上传失败'));
	        }
        }
    }
}
