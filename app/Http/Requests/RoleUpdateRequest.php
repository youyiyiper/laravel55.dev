<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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

        $rules = [
            'name' => 'required|between:2,30|unique:roles,name,'.$id.',id',
            'desc' => 'required|between:2,20',
            'status' => 'between:0,1',
        ];

        $permission = \Request::has('permission');
        if (!empty($permission)) {
            $rules['permission'] = 'required|array';
            $rules['permission.*'] = 'required|distinct|min:1';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => '角色名称不能为空',
            'name.between'       => '角色名称必须是2~30位之间',
            'name.unique'       => '角色名称已经存在',
            'desc.required' => '角色描述不能为空',
            'desc.between'  => '角色描述必须是2~30位之间',
            'status.between'  => '状态错误',
        ];

        $permission = \Request::has('permission');
        if (!empty($permission)) {
            $messages['permission.distinct'] = '权限不能重复';
        }

        return $messages;
    }
}
