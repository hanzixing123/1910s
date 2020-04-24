<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;//第二中的
use Validator;//第三种
use Illuminate\Validation\Rule;//第三种
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 列表展示
     */
    public function index()
    {

            

        // 打印库里数据  
        //$list=DB::table("brand")->get();
        // 分页+搜索
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where[]=["brand_name","like","%$brand_name%"];
        }
        $pageSize=config("app.pageSize");
        $list=Brand::orderBy("brand_id","asc")->where($where)->paginate($pageSize);//orm操作
            //dd(request()->ajax());
            if(request()->ajax()){
                return view("admin.brand.ajaxindex",['brand'=>$list,'brand_name'=>$brand_name]);
            }
        //dd($list);
        return view("admin.brand.index",['brand'=>$list,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *添加方法(表单页面)
     */
    public function create()
    {
        //
        return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *      
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *添加方法(入库)
     */
    //
        //第二种
    //public function store(StoreBrandPost $request)
    public function store(Request $request)
    {   
        //第一种
        // $request->validate([
        //     'brand_name'=>"required|unique:brand|max:20",
        //     "brand_url"=>"required",
        //     ],[
        //     "brand_name.required"=>"品牌名称必填",
        //     "brand_name.unique"=>"品牌已存在",
        //     "brand_name.max"=>"品牌名称最大为20位",
        //     "brand_url.required"=>"品牌网址必填",
        //     ]);
         
        //不接收 
        $post=request()->except(['/brand/store','_token']);
        //只接收  //$post=request()->only(['brand_name','brand_url','brand_desc']);
        
        //第三种  必须在接值下面
        $validaor=Validator::make($post,[
            'brand_name'=>"required|unique:brand|max:20",
            "brand_url"=>"required"],[
            "brand_name.required"=>"品牌名称必填",
            "brand_name.unique"=>"品牌已存在",
            "brand_name.max"=>"品牌名称最大为20位",
            "brand_url.required"=>"品牌网址必填",] );
            if($validaor->fails()){
                return redirect("brand/create")->withErrors($validaor)->withInput();
            }
            // 第三种结束
       // dd($post);die;//dd 打印
        //处理图片 hasFile 方法判断文件在请求中是否存在
            if($request->hasFile("brand_logo")){
                $post['brand_logo']=tupian("brand_logo");//upload自定义的方法
            }

        //添加
          // $res= DB::table('brand')->insert($post);
            //orm添加
            //————————————————添加方法1————————————————————————————————————————————
            //使用该方法需要 实例化 Brand 模型 在着步添加
            // $brand=new Brand;
            // $brand->brand_name=$post['brand_name'];
            // $brand->brand_url=$post['brand_url'];
            // $brand->brand_logo=$post['brand_logo'];
            // $brand->brand_desc=$post['brand_desc'];
            // $res=$brand->save();
            //—————————————————————添加方法2———————————————————————————————————————
                // 使用 create方法 需要开启黑名单
               // $res=brand::create($post);
            //—————————————————————添加方法3———————————————————————————————————————
                // 使用 create方法 需要开启黑名单
                $res=brand::insert($post);

            if($res){
                return redirect("/brand");
            }
    }
                        //自定义的方法  传参和接参可以不一样
    /**
     * Display the specified resource.
     *  预览详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *  修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改第一页面
        //$res=DB::table('brand')->where('brand_id',$id)->first();
        //rom 方式
            $res=Brand::find($id);//rom 方式
          //$res=Brand::where('brand_id',$id)->first();//rom 方式
      
        return view("admin.brand.edit",['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *      应该是修改第二个页面
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $post=request()->all();
        // dd($post);
        //处理 编辑信息  把没有用的 令牌删除
        $post=$request->except(['_token','/brand/update/'.$id]);
        //验证————————————————————————————————————————————————————————————————
        $validaor=Validator::make($post,[  // 排除自身ID
            'brand_name'=>["required",Rule::unique("brand")->ignore($id,'brand_id'),
            "max:20",
            ],
            "brand_url"=>"required",
        ],[
           "brand_name.required"=>"品牌名称必填",
            "brand_name.unique"=>"品牌已存在",
            "brand_name.max"=>"品牌名称最大为20位",
            "brand_url.required"=>"品牌网址必填",    
                          ]);

            if($validaor->fails()){//有错走这个判断
                return redirect("brand/edit/".$id)->withErrors($validaor)->withInput();
            }

        //验证————————————————————————————————————————————————————————————————
        //处理图片 hasFile 方法判断文件在请求中是否存在
            if($request->hasFile("brand_logo")){
                $post['brand_logo']=tupian("brand_logo");//upload自定义的方法
            }

       // dd($post);
        //$res=DB::table('brand')->where('brand_id',$id)->update($post);
            //rom 操作
          //————————————————修改方法1————————————————————————————————————————————
            // $brand =Brand::find($id);
            // $brand->brand_name=$post['brand_name'];
            // $brand->brand_url=$post['brand_url'];
            // if(isset($post['brand_logo'])){
            //     $brand->brand_logo=$post['brand_logo'];
            // }            
            // $brand->brand_desc=$post['brand_desc'];
            // $res=$brand->save();
            //
          //————————————————修改方法2————————————————————————————————————————————
                // 用的 黑名单
                $res=brand::where('brand_id',$id)->update($post); 
          //————————————————————————————————————————————————————————————

        if($res!==false){
            return redirect("/brand");
        }

    }

    /**
     * Remove the specified resource from storage.
     *  删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            //删除方法
        //======= 删除 图片
           
            $brand_logo=DB::table('brand')->where('brand_id',$id)->value('brand_logo');  
                   //  dd(storage_path('app/'.$brand_logo));die; 
            if($brand_logo){
                unlink(storage_path('app/'.$brand_logo));              
            }
        //=========

           //$res= DB::table('brand')->where('brand_id',$id)->delete();
            //rom 操作
            $res=Brand::destroy($id);
        if($res){
            return redirect("/brand");  
        }
    }

}
