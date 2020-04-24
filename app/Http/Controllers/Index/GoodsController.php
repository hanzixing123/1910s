<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Userss;
use App\Car;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    	public function index(){
    		//商品
            $goodslist=Cache::get('goodslist');
            if(!$goodslist){
    		      echo "DB";
            $goodslist=Goods::all();
           
             Cache::put('goodslist',$goodslist,30);
    	           }
                   echo "已缓存";
    		//$list=Goods::all();
    		return view("index.goodsList",['res'=>$goodslist]);
    	}


    	public function proinfo($id){
    		

            $num=Redis::setnx("num".$id,60,1)?1:Redis::incr('num'.$id);

           //dd($num);
           //$num= Redis::incr('num'.$id);
            $res=Goods::find($id);
            //Redis::del();
		//dump($num);
            //dd($res);
				return view("index.proinfo",['res'=>$res,'num'=>$num]);


    	}



        public function addcar(){
            //商品ID +预购买数量
            $goods_id=request()->goods_id;
            $buy_num=request()->buy_num;
            //判断是否登录
               if(!session('user')){
                    echo  returnjson('00002','未登录');
               }
               //查询登录的用户ID   根据登录的手机号或邮箱查询登录的用户ID
               $user_id=Userss::where('user_name',session('user'))->value('user_id');
               //dd($user_id);
               //根据 商品ID来查询数据
               $goods=Goods::select('goods_id','goods_price','goods_name','img','goods_num')->find($goods_id);
                //购买数量大于库存,把库中的数量给他
               if($goods->goods_num<$buy_num){
                echo returnjson("00001","库存不足....只剩下".$goods->goods_num."件商品.....");}
                //根据 用户ID和商品ID查询是否购买过此商品
                $where=[
                    'user_id'=>$user_id,
                    'goods_id'=>$goods_id
                ];
                //查询是否有数据
                $car=Car::where($where)->first();
                if($car){
                    //修改  走此说明已经购买过此商品
                    $buy_num=$car->buy_num+$buy_num;
                    //判断 剩余的商品数量是否足够
                    if($goods->goods_num<$buy_num){
                        //商品不足,把库中的数据给他
                        $buy_num=$goods->goods_num;
                    }
                        $res=Car::where('cart_id',$car->cart_id)->update(['buy_num'=>$buy_num]);
                
                }else{
                
                    //添加
                    $data=[
                        'user_id'=>$user_id,
                        'buy_num'=>$buy_num,
                        'addtime'=>time()
                    ];
                    //将查询出来的结果集 变量goods 转换为数组，并合并需要的数据
                    $data=array_merge($data,$goods->toArray());    
                    unset($data['goods_num']);
                   // dd($data);
                    $res=Car::create($data);  
                }
                if($res!==false){
                    returnjson("00000",'加入购物车成功！');
                }





        }





 }
