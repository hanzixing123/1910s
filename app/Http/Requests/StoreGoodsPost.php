<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;//第三种


class StoreGoodsPost extends FormRequest
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
        $name=\Route::currentRouteName();
        //dd($name);
        if($name=="goodsstore"){
        return [       
            "goods_name"=>"required|unique:goods|regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u", 
            "goods_price"=>"required|numeric",
            "goods_num"=>"required|numeric|regex:/^\d{1,8}$/",
            "cate_id"=>"required",
            "brand_id"=>"required",
            "goods_desc"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u",
        ];
    }
    if($name=="goodsupdate"){
              return [  // 排除自身ID //unique 里写表名
            'goods_name'=>[
            Rule::unique("goods")->ignore(request()->id,'goods_id'),
            "regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u"
            ],
            "goods_price"=>"required|numeric",
            "goods_num"=>"required|numeric|regex:/^\d{1,8}$/",
            "cate_id"=>"required",
            "brand_id"=>"required",
            "goods_desc"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u",
        ];
    }



    }
    public function messages(){
        return [
            "goods_name.required"=>"商品名称不可为空",
            "goods_name.unique"=>"商品名称已存在",
            "goods_name.regex"=>"商品名称必须是汉字而且在2位到10位之间",
            "goods_price.required"=>"商品价格不可为空",
            "goods_price.numeric"=>"商品价格必须是数字",
            "goods_num.required"=>"商品库存不可为空",
            "goods_num.numeric"=>"商品库存必须是数字",
            "goods_num.regex"=>"商品库存不可超过8位",
            "cate_id.required"=>"商品分类必选",
            "brand_id.required"=>"商品品牌必选",
            "goods_desc.required"=>"商品详情不可为空",
            "goods_desc.regex"=>"商品详情至少2位!!!!!!!!!!!!!!!",
        ];
    }


}
