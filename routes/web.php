<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('han', function () {
    return "欢迎 离殇.";
});
Route::get('/hanzi',"IndexController@index"); 
Route::post("/index/add","IndexController@add");
Route::get("/zi/{id}/{name}","IndexController@kk")->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);
// Route::get("/zi/{id}/{name}","IndexController@kk")->where('id',"\d+");
Route::get('ll', function () {
    return view("index",["kk"=>"杨文龙",'k'=>"kk"]);
});
// Route::get("/kk/{id}/{name}","IndexController@kk");
 // Route::get("/kk/{name}","IndexController@kkk")->where();
// Route::get('/ksk/{id?}', function ($id=0) {
//     echo $id;
// });
// Route::get("/kk/{id?}/{name?}","IndexController@kk")->where('id','\d');
Route::get("/cookie","IndexController@cookie");
Route::get("/cookies","IndexController@cookies");





	Route::domain("admin.laravel.com")->group(function(){
		// 后台 brand 品牌
Route::prefix("/brand")->middleware("isLogin")->group(function(){
	Route::get('create',"Admin\BrandController@create"); //添加页面
	Route::post("store","Admin\BrandController@store");  //执行添加方法
	Route::get("/","Admin\BrandController@index");  //执行展示页面
	Route::get("destroy/{id}","Admin\BrandController@destroy"); //删除
	Route::get("edit/{id}","Admin\BrandController@edit"); //修改
	Route::post("update/{id}","Admin\BrandController@update"); //执行修改
});
		//后台 category  分类
Route::prefix("/category")->middleware("isLogin")->group(function(){
	Route::get("create","Admin\CategoryController@create");//添加页面
	Route::post("store","Admin\CategoryController@store");//执行添加方法
	Route::get("/","Admin\CategoryController@index");//执行展示页面
	Route::get("destroy/{id}","Admin\CategoryController@destroy");//删除
	Route::get("edit/{id}","Admin\CategoryController@edit");//修改
	Route::post("update/{id}","Admin\CategoryController@update"); //执行修改
});
	// 后台 goods  商品
Route::prefix("/goods")->middleware("isLogin")->group(function(){
	// 路由 any 支持所有的路由方式  match 可以制定多种路由方式
	Route::get("create","Admin\GoodsController@create");//添加页面
	Route::post("store","Admin\GoodsController@store")->name("goodsstore");//执行添加页面
	Route::any("/","Admin\GoodsController@index");// 展示
	Route::get("destroy/{id}","Admin\GoodsController@destroy");//删除
	Route::get("edit/{id}","Admin\GoodsController@edit");//修改
	Route::post("update/{id}","Admin\GoodsController@update")->name("goodsupdate"); //执行修改
});

Route::prefix("/curd")->group(function(){
	Route::get("create","Admin\CurdController@create");//添加页面
	Route::post("store","Admin\CurdController@store");//执行添加页面
	Route::get("/","Admin\CurdController@index");// 展示
	Route::get("destroy/{id}","Admin\CurdController@destroy");//删除
	Route::get("edit/{id}","Admin\CurdController@edit");//修改
	Route::post("update/{id}","Admin\CurdController@update"); //执行修改
});
Route::prefix("/Login")->group(function(){
	Route::get("create","Admin\LoginController@create");//添加页面
	Route::post("store","Admin\LoginController@store");//执行添加页面
	Route::any("tc","Admin\LoginController@tc");//执行添加页面
});
		//网站连接  
Route::prefix("/lianjie")->group(function(){
	Route::get("create","Admin\LianjieController@create");//添加页面
	Route::post("store","Admin\LianjieController@store")->name("goodsstore");//执行添加页面
	Route::any("/","Admin\LianjieController@index");// 展示
	Route::get("destroy/{id}","Admin\LianjieController@destroy");//删除
	Route::get("edit/{id}","Admin\LianjieController@edit");//修改
	Route::post("update/{id}","Admin\LianjieController@update")->name("goodsupdate"); //执行修改

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});
//——————————————————————前———————————————台—————————路—————————————由————————————————————//
route::domain("www.laravel.com")->group(function(){
	Route::get("/","Index\IndexController@index")->name('shop.index');//主页路由
	Route::get("/login","Index\LoginController@login");//登录页面路由
	Route::post("/loginto","Index\LoginController@loginto");//验证登录路由
	Route::get("/reg","Index\LoginController@reg");//注册页面路由
	Route::post("/sendSms","Index\LoginController@sendSms");//手机号验证路由
	Route::get("/sendEmail","Index\LoginController@sendEmail");//邮箱验证路由
	route::post("/useradd","Index\LoginController@useradd");//执行注册路由
	route::get("/goodsList","Index\GoodsController@index");//执行注册路由
	route::get("/proinfo/{id}","Index\GoodsController@proinfo")->name('shop.goods');
	route::get("/addcar","Index\GoodsController@addcar");
	route::get("/car","Index\CarController@index")->name('shop.car');//购物车页面
	route::get("/jiajian","Index\CarController@jiajian");//加减
	route::get("/cardel/{id}","Index\CarController@cardel");//去结算
	route::get("/pay","Index\CarController@pay")->name('shop.car');//。。。。
	
});	

