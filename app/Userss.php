<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    //
    protected $table="userss";
	protected $primaryKey ="user_id";

	//关闭时间戳
public $timestamps=false;

// 黑名单属性
protected $guarded=[];
}
