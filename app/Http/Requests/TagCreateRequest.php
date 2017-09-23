<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest
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
            'name' => 'required|between:2,30|unique:tags'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '标签名称不能为空',
            'name.between'       => '标签名称必须是2~30位之间',
            'name.unique'       => '标签名称已经存在',
        ];
    }
}
