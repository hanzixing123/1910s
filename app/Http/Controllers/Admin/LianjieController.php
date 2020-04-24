<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLianjiePost;//第二中的
use App\Lianjie;
//use App\Http\Requests\StoreGoodsPost;
class LianjieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $mingcheng=request()->mingcheng;
        $radio=request()->radio;
        //dd($mingcheng);
        $where=[];
        if($mingcheng){
            $where[]=["name","like","%$mingcheng%"];
        }
        if($radio){
             $where[]=["radio","like","%$radio%"];
        }

        //dump(request()->all());
        $pageSize=config('app.pageSize');
        $all=Lianjie::where($where)->paginate($pageSize);
       // dd($all);
            if(request()->ajax()){
        return view("admin.lianjie.ajaxindex",['all'=>$all,"mingcheng"=>$mingcheng,'radio'=>$radio]); 
            }

        return view("admin.lianjie.index",['all'=>$all,"mingcheng"=>$mingcheng,'radio'=>$radio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

            return view("admin.lianjie.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLianjiePost $request)
    {
        //

        $res=request()->except(['/lianjie/store','_token']);
               //处理图片 hasFile 方法判断文件在请求中是否存在
        
        if($request->hasFile("img")){
            $res["img"]=tupian("img");//tupian 是在app\Gonggongfangfa\functions 中的方法
        }//dd($res);
        $lian=Lianjie::insert($res);
        if($lian){
            return redirect("/lianjie");
        }
     //   dd($res);
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
        //
        $res=Lianjie::find($id);
        if($res){
          return  view("admin.lianjie.edit",['res'=>$res]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLianjiePost $request, $id)
    {
        //
        $post=$request->except(['_token','/lianjie/update/'.$id]);
        if($request->hasFile("img")){
                $post['img']=tupian("img");//upload自定义的方法
            }
            $res=Lianjie::where("id",$id)->update($post);
            if($res!==false){
                return redirect("/lianjie");
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
        $res=Lianjie::destroy($id);
    }
}
