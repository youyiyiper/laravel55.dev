<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 裁剪图片
 */
class CropController extends Controller
{
    /**
     * 上传图片
     *
     * @param Request $request
     * @return mixed
     */
    public function upload(Request $request)
    {
        $form_data = $request->all();

        $rules = [
            'img' => 'required|mimes:png,gif,jpeg,jpg,bmp'
        ];

        $messages = [
            'img.mimes' => 'Uploaded file is not in image format',
            'img.required' => 'Image is required'
        ];

        $validator = Validator::make($form_data, $rules, $messages);

        if ($validator->fails()) {
            return Response::json([
                'status' => 'error',
                'message' => $validator->messages()->first(),
            ], 200);
        }

        $img = $form_data['img'];

        $original_name = $img->getClientOriginalName();
        $original_name_without_ext = substr($original_name, 0, strrpos($original_name,'.'));

        #$filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename();

        $filename_ext = $allowed_filename .'.jpg';

        $manager = new ImageManager();

        $date = date('Ymd');
        $path = $this->createPath();

        $image = $manager->make( $img )->save($path .'/'.$filename_ext );

        if( !$image) {
            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);
        }

        return Response::json([
            'status'    => 'success',
            'url'       => env('APP_URL') . '/uploads/' .$date.'/'. $filename_ext,
            'width'     => $image->width(),
            'height'    => $image->height()
        ], 200);
    }

    /**
     * 裁剪图片
     *
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $form_data = $request->all();
        $image_url = $form_data['imgUrl'];

        // resized sizes
        $imgW = $form_data['imgW'];
        $imgH = $form_data['imgH'];
        // offsets
        $imgY1 = $form_data['imgY1'];
        $imgX1 = $form_data['imgX1'];
        // crop box
        $cropW = $form_data['width'];
        $cropH = $form_data['height'];
        // rotation angle
        $angle = $form_data['rotation'];

        $filename_array = explode('/', $image_url);
        $filename = $filename_array[sizeof($filename_array)-1];

        $manager = new ImageManager();
        $image = $manager->make( $image_url );
        $date = date('Ymd');
        $path = $this->createPath();

        $image->resize($imgW, $imgH)
            ->rotate(-$angle)
            ->crop($cropW, $cropH, $imgX1, $imgY1)
            ->save($path . '/cropped-' . $filename);

        if( !$image) {
            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);
        }

        //删除上传的图片 保留裁剪后的图片
        unlink('./uploads/'.$date.'/' . $filename);

        return Response::json([
            'status' => 'success',
            'url' => env('APP_URL') . '/uploads/'.$date.'/cropped-' . $filename
        ], 200);
    }

    /**
     * 创建目录
     */
    private function createPath()
    {
        $date = date('Ymd');
        $path = env('UPLOAD_PATH').$date;
        if (!is_dir($path)) {
            mkdir($path,0777,true);
        }
        return $path;
    }

    /**
     * 创建唯一文件名
     *
     * @param Request $request
     * @return mixed
     */
    private function createUniqueFilename( )
    {
        $filename = time().mt_rand();

        $path = $this->createPath();

        $full_image_path = $path . '/'. $filename . '.jpg';

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $image_token;
        }

        return $filename;
    }
}