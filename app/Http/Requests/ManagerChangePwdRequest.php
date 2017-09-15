<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerChangePwdRequest extends FormRequest
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
            'name' => 'required|between:2,20',
            'password' => 'required|confirmed|between:6,20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '密码不能为空',
            'name.between'       => '用户名必须是2~20位之间',
            'password.required' => '密码不能为空',
            'password.between'  => '密码必须是6~20位之间',
            'password.confirmed' => '新密码和确认密码不匹配'
        ];
    }
}
