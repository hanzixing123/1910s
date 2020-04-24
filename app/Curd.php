<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curd extends Model
{
    //
	protected $table="curd";
	protected $primaryKey ="curd_id";
	//关闭时间戳
public $timestamps=false;

// 黑名单属性
protected $guarded=[];


}
