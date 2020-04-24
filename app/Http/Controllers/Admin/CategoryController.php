<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res=category::get();
        $res=createTree($res);
        return view("admin.category.index",['category'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加方法
        $list=Category::all();//orm操作
        $list=createTree($list);
         return view("admin.category.create",['aa'=>$list]);

    }
    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //入库
        //$post=request()->all();
       
        $post=request()->except(['_token','/category/store']);  
        $res=category::insert($post);
        if($res){
            return  redirect("/category");
        }
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
            $aa=category::all();//dd($aa);die;
             $aa=createTree($aa);
            $res=category::find($id);
          return view("admin.category.edit",['cate'=>$res,"aa"=>$aa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post=request()->except(['_token','/category/update/'.$id]);//dd($post);die;
        $res=Category::where("cate_id",$id)->update($post);
        if($res!==false){
            return redirect("/category");
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
        //删除方法    
        $res=category::destroy($id);
        if($res){
            return redirect("/category");
        }
    }
}
