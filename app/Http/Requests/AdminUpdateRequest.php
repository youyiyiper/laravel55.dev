<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,'.$id,',id',
            'name' => 'required|between:2,20',
            'role_id' => 'required|min:1',
        ];

        $password = \Request::input('password');
        if (!empty($password)) {
            $rules['password'] = 'required|confirmed|between:6,30';
        }

        return $rules;

    }

    public function messages()
    {
        $messages =  [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',
            'name.required'       => '名称不能为空',
            'name.between'       => '名称必须是2~20位之间'
        ];

        $password = \Request::input('password');
        if (!empty($password)) {
            $messages['password.required'] = '密码不能为空';
            $messages['password.between'] = '密码必须是6~30位之间';
            $messages['password.confirmed'] = '新密码和确认密码不匹配';
        }

        return $messages;
    }
}
