<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
        return [
            'email' => 'required|email|unique:admins',
            'name' => 'required|between:2,20',
            'password' => 'required|confirmed|between:6,20',
            'role_id' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',
            'name.required'       => '名称不能为空',
            'name.between'       => '名称必须是2~30位之间',
            'password.required' => '密码不能为空',
            'password.between'  => '密码必须是6~20位之间',
            'password.confirmed' => '新密码和确认密码不匹配',
            'role_id.required'  => '角色必须',
        ];
    }
}
