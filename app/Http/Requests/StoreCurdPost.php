<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurdPost extends FormRequest
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
            "curd_name"=>"required|unique:curd|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{0,18}$/u",
            "tel"=>"required|regex:/^[1][3,4,5,7,8][0-9]{9}$/u",
            "email"=>"required|regex:/^[0-9a-zA-Z]{6,}@qq.com$/",
            "pwd"=>"required|regex:/^[0-9a-zA-Z]{6,}$/",
        ];
    }

public function messages(){
        return [
            "curd_name.required"=>"用户名称不可为空",
            "curd_name.unique"=>"用户名称已存在",
            "curd_name.regex"=>"用户名称必须是汉字而且在2位到10位之间",
            "tel.required"=>"用户手机号不可为空",
            "tel.regex"=>"必须是正确手机号,必须以13,14,15,17,18,为开头,而且必须是11位!!!!",
            "email.required"=>"邮箱不可为空",
            "email.regex"=>"邮箱格式不正确",
            "pwd.required"=>"密码不可为空",
            "pwd.regex"=>"密码格式不正确",
            // "cate_id.required"=>"商品分类必选",
            // "brand_id.required"=>"商品品牌必选",
            // "goods_desc.required"=>"商品详情不可为空",
            // "goods_desc.regex"=>"商品详情至少2位!!!!!!!!!!!!!!!",
        ];
    }



}