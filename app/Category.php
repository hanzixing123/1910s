<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $table="category";
	protected $primaryKey ="cate_id";
	//关闭时间戳
public $timestamps=false;

// 黑名单属性
protected $guarded=[];




}
