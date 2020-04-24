<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
	protected $table="goods";
	protected $primaryKey ="goods_id";

	//关闭时间戳
public $timestamps=false;

// 黑名单属性
protected $guarded=[];


	public  static function getGoods($where,$pageSize){
		$goods=self::select("goods.*","category.cate_name","brand.brand_name")
                     ->leftjoin("brand","goods.brand_id",'=',"brand.brand_id")
                 ->leftjoin("category","goods.cate_id",'=',"category.cate_id")
                ->where($where)->paginate($pageSize);
                return $goods;
	}

	public  static  function getIndexSilde(){
			return Goods::select('goods_id','img')->where('is_silde',1)->take(5)->get();
	}


}
