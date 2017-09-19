<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'title' => 'required|between:2,50|unique:articles,title,'.$id.',id',
            'desc' => 'required|between:2,120',
            'is_top' => 'required|between:0,1',
            'category_id' => 'required|min:1',
            'tag' => 'required|array',
            'tag.*' => 'required|distinct|min:1',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.between'       => '标题必须是2~50位之间',
            'title.unique'       => '标题已经存在',
            'desc.required' => '描述不能为空',
            'desc.between'  => '描述必须是2~120位之间',
            'is_top.required' => '请选择是否置顶',
            'is_top.between' => '请选择是否置顶',
            'category_id.required' => '请选择分类',
            'tag.required'  => '请选择标签',
            'tag.distinct'  => '标签不能重复',
            'content.required'  => '内容不能为空',
        ];
    }
}
