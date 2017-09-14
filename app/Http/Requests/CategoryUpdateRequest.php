<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Request::segment(3);
        return [
            'name' => 'required|between:2,30|unique:categorys,name,'.$id.',id',
            'flag' => 'required|between:2,30|unique:categorys,flag,'.$id.',id',
            'desc' => 'required|between:2,100',
            'pid' => 'min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名称不能为空',
            'name.between'       => '分类名称必须是2~30位之间',
            'name.unique'       => '分类名称已经存在',
            'flag.required' => '分类标识不能为空',
            'flag.between'       => '分类标识必须是2~30位之间',
            'flag.unique'       => '分类标识已经存在',
            'desc.required' => '分类描述不能为空',
            'desc.between'  => '分类描述必须是2~100位之间',
            'pid.min'  => '请选择父类',
        ];
    }
}
