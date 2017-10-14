<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigUpdateRequest extends FormRequest
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
            'name' => 'required|between:2,30|unique:configs,name,'.$id.',id',
            'keyword' => 'required|between:2,30|unique:configs,keyword,'.$id.',id',
            'content' => 'required|min:2',
        ];        
    }

    public function messages()
    {
        return [
            'name.required' => '配置名称不能为空',
            'name.between'       => '配置名称必须是2~30位之间',
            'name.unique'       => '配置名称已经存在',
            'keyword.required' => '配置标识不能为空',
            'keyword.between'       => '配置标识必须是2~30位之间',
            'keyword.unique'       => '配置标识已经存在',
            'content.required' => '配置内容不能为空',
            'content.min'  => '内容内容最小一位字符',
        ];
    }
}
