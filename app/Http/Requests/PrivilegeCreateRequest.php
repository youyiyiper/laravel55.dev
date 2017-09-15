<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivilegeCreateRequest extends FormRequest
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
        $rules = [
            'name' => 'required|between:2,30|unique:privileges',
            'flag' => 'required|between:2,50|unique:privileges',
            'desc' => 'required|between:2,50',
        ];

        if (\Request::has('permission')) {
            $rules['permission'] = 'required|array';
            $rules['permission.*'] = 'required|distinct|min:1';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => '权限名称不能为空',
            'name.between'      => '权限名称必须是2~30位之间',
            'name.unique'       => '权限名称已经存在',
            'flag.required'     => '权限标识不能为空',
            'flag.between'      => '权限标识必须是2~50位之间',
            'flag.unique'       => '权限标识已经存在',
            'desc.required'     => '权限描述不能为空',
            'desc.between'      => '权限描述必须是2~50位之间',
        ];
    }
}
