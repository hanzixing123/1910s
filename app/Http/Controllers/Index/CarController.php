<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Car;
use App\Userss;
use DB;
class CarController extends Controller
{
	public function index(){
			$user_id=Userss::where('user_name',session('user'))->value('user_id');

		$car=\DB::select("select * ,buy_num*goods_price as price from car where user_id=?",[$user_id]);
		     		//dd($car);
			//每个商品的购买数量
			$buy_num=array_column($car,'buy_num');
					//dd($buy_num);
			//总购买商品件数
			$count=array_sum($buy_num);
			//dd($count);
			//购物车ID
			$cart_id=array_column($car,"cart_id");

			$checkedbuynumber=array_combine($cart_id,$buy_num);
			//总价钱
			$totalprice=array_sum(array_column($car,'price'));

			//dd($user_id);
		//$res=Car::where('user_id',$user_id)->join('goods','goods.goods_id','=','car.goods_id')->get();
		//dd($car);
		return view("index.car",compact('car','count','checkedbuynumber','totalprice'));
	}

	public function jiajian(){
		$cart_id=request()->cart_id;

		$buy_num=request()->buy_num;

		  // echo $buy_num;//$buy_num;
		  $car=Car::where('cart_id',$cart_id)->update(['buy_num'=>$buy_num]);
		  echo returnjson("1","成功");

	}


	public function   cardel(){
		$id= request()->id;
		$user_name=session("user");
	//	dd($user_id);
		$user_id=Userss::where('user_name',$user_name)->value('user_id');
		//dd($user_id);
		//$id=$id->toArray();
		//dd($id);
		//$id=implode(",",$id);
		$where=[
				'cart_id'=>$id,
				'user_id'=>$user_id
			];
		$res=Car::where($where)->get();
		//dd($res);
		return  view("index.pay",['res'=>$res]);

	}




}
