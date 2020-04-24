<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //
    public function Index(){

    		//$silde=Goods::select('goods_id','img')->where('is_silde',1)->take(5)->get();
    			
                  // 一  
                    //$silde=Cache::get("silde");
                //  二
                //$silde=Redis::get("silde");
               // dd($silde);
                   // dump($silde);
                    //使用 辅助函数  调出
                    $silde=cache('silde');
                dump($silde);
                if(!$silde){
                  //  echo "DB";    
                    $silde=Goods::getIndexSilde();
                        // 一  
                    //Cache::put('silde',$silde,30);
                        //   二
                                //序列化
                    //$silde=serialize($silde);
                    //  $silde=Redis::setex("silde",60,$silde); 
                      cache(['silde'=>$silde],60);

                }  

                  //  dd($silde);
                   // $silde=unserialize($silde); //反序列化
                        //使用 辅助函数   设置
                       
                //echo "已缓存"; 
                //幻灯片
    		
    			


                //商品数据
    			$res=Goods::all();

    		//dd($silde);
    	return view("index.index",['silde'=>$silde,'res'=>$res]);
		 }

    


}
