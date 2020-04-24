<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLianjiePost extends FormRequest
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
            "name"=>"required|unique:lianjie|regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u",
            "url"=>"required|unique:lianjie|",//regex:/^http:\/\/\w\.\{7,}$/
            "Contact"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u",
            "desc"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u",
        ];
      }
      public function messages(){
        return [
            "name.required"=>"网站名称不可为空！",
            "name.unique"=>"网站名称已存在！",
            "name.regex"=>"网站名称格式不正确,可以是汉字字母数字组成！",
            "url.required"=>"网址名称不可为空！",
            "url.unique"=>"网址名称已存在！",
            "Contact.required"=>"网站联系人不可为空！",
            "Contact.regex"=>"网站联系人名称格式不正确,可以是汉字字母数字组成",
            "desc.required"=>"网站介绍不可为空！",
            "desc.regex"=>"网站介绍格式不正确,可以是汉字字母数字组成",
        ];

      }

}
