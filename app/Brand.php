<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
	protected $table="brand";
	protected $primaryKey ="brand_id";

	//关闭时间戳
public $timestamps=false;

// 黑名单属性
protected $guarded=[];

	public function Goods(){
			return $this->morphOne("App\Goods","Goodsable");
	}


}
