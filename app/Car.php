<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
	protected $table="car";
	protected $primaryKey ="cart_id";
	//关闭时间戳
	public $timestamps=false;

	// 黑名单属性
	protected $guarded=[];

	



}
