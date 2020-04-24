<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;//分类表
use App\Goods;//商品表

use App\Brand;//品牌表
use App\Http\Requests\StoreGoodsPost;
use Validator;//第三种
use Illuminate\Validation\Rule;//第三种
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //数据
        $goods_name=request()->goods_name;
        $brand_id=request()->brand_id;
        $cate_id=request()->cate_id;
        //处理 
      //  dd($brand_id);
        $where=[];
        if($goods_name){
            $where[]=["goods_name","like","%$goods_name%"];
        }
        if($brand_id){
            $where[]=["goods.brand_id",$brand_id];
        }
        if($cate_id){
            $where[]=["goods.cate_id",$cate_id];
        }


        $pageSize=config("app.pageSize");
        //$goods=goods::paginate($pageSize);
        $brand=brand::all();
        $cate=Category::all();
        $cate=createTree($cate);
         //DB::connection()->enableQueryLog();
          $goods=Goods::getGoods($where,$pageSize);
         // $goods=Goods::select("goods.*","category.cate_name","brand.brand_name")
         //        ->leftjoin("brand","goods.brand_id",'=',"brand.brand_id")
         //        ->leftjoin("category","goods.cate_id",'=',"category.cate_id")
         //        ->where($where)->paginate($pageSize);

    //$logs = DB::getQueryLog();
    //dd($logs);
          // dd($goods);
         //$goods['imgs']=explode("|",$goods['imgs']);
         //dd($goods);
         $query=request()->all();
        // dd($query);
         if(request()->ajax()){
        return view("admin.goods.ajaxindex",['goods'=>$goods,'brand'=>$brand,'cate'=>$cate,'query'=>$query]);
         }
        return view("admin.goods.index",['goods'=>$goods,'brand'=>$brand,'cate'=>$cate,'query'=>$query]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //form表单
        $list=Category::all();
        $cate_id=createTree($list);
        //dd($cate_id);die;
        $brand_id=Brand::all();
        //dd($brand_id);die;
        return view("admin.goods.create",['cate_id'=>$cate_id,'brand_id'=>$brand_id]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        $res=request()->except(['/goods/store','_token']);
            $res['goods_no']=time();
          // dd($res);die;
        //————————————————————————————————————————————————————————————————————————————
          //处理图片 hasFile 方法判断文件在请求中是否存在
        if($request->hasFile("img")){
            $res["img"]=tupian("img");//tupian 是在app\Gonggongfangfa\functions 中的方法
        }
            //处理图集
            if(isset($res['imgs'])){
                $imgs=tupians("imgs");
                $res['imgs']=implode('|',$imgs);
            }
        //——————————————————————————————————————————————————————————————————————————————————
        $list=Goods::insert($res);
            if($res){ 
                return redirect("/goods");
            }
       //dd($res);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改第一个页面
        $goods=goods::find($id);
        //dd($goods);die;
        $brand=brand::all();
        $cate=Category::all();
        $cate=createTree($cate);
         return view("admin.goods.edit",['goods'=>$goods,'brand_id'=>$brand,'cate_id'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    { //修改
             $post=$request->except(['_token','/goods/update/'.$id]);
            
        //  $validaor=Validator::make($post,[  // 排除自身ID //unique 里写表名
        //     'goods_name'=>["required",Rule::unique("goods")->ignore($id,'goods_id'),
        //     "regex:/^[\x{4e00}-\x{9fa5}\w]{2,10}$/u"
        //     ],
        //     "goods_price"=>"required|numeric",
        //     "goods_num"=>"required|numeric|regex:/^\d{1,8}$/",
        //     "cate_id"=>"required",
        //     "brand_id"=>"required",
        //     "goods_desc"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u",
        // ],[
        //     "goods_name.required"=>"商品名称不可为空",
        //     "goods_name.unique"=>"商品名称已存在",
        //     "goods_name.regex"=>"商品名称必须是汉字而且在2位到10位之间",
        //     "goods_price.required"=>"商品价格不可为空",
        //     "goods_price.numeric"=>"商品价格必须是数字",
        //     "goods_num.required"=>"商品库存不可为空",
        //     "goods_num.numeric"=>"商品库存必须是数字",
        //     "goods_num.regex"=>"商品库存不可超过8位",
        //     "cate_id.required"=>"商品分类必选",
        //     "brand_id.required"=>"商品品牌必选",
        //     "goods_desc.required"=>"商品详情不可为空",
        //     "goods_desc.regex"=>"商品详情至少2位!!!!!!!!!!!!!!!",
        //                   ]);
        //     if($validaor->fails()){//有错走这个判断
        //            return redirect("goods/edit/".$id)->withErrors($validaor)->withInput();
        //     }

            if($request->hasFile("img")){
                $post['img']=tupian("img");//upload自定义的方法
            }
           if(isset($post['imgs'])){
                $imgs=tupians("imgs");
                $post['imgs']=implode('|',$imgs);
            }

            //dd($post);
            $res=Goods::where("goods_id",$id)->update($post);
            if($res!==false){
                return redirect("/goods");
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        //
            $img=goods::where("goods_id",$id)->value('img');
                //dd(storage_path('app/'.$img));die;
                if($img){
                    unlink(storage_path('app/'.$img));
                }
            //dd($img);
        $res=goods::destroy($id);
        if($res){
            return redirect("/goods");
        }

    }
}
