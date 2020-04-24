<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class IndexController extends Controller
{
    public function index(){
    		return view("index",['kk'=>"杨文龙",'k'=>"kk"]);
    }
    public function add(){
    	echo "离殇.";
    	$post=request()->all();
    	dd($post);
    }
    public function kk($id,$name){
    	 echo  "name是".$name."<br>";
    	  echo  "id是".$id;
    }

    public function kkk($name){
    	
    	  echo  "名字是".$name;
    }
    public function cookie(){
        //return response("设置cookie")->cookie("name","哈皮",1);
        Cookie::queue("num","kk",1); 
    }
    public function cookies(){
        echo request()->cookie("num");

    }


}
?>