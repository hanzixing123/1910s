<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Curd;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // dd(11);
            //$curd=[['curd_name'=>'','pwd'=>'']];
            //dd($curd);
           //   if(request()->cookie("user")){
           //       $aa=request()->cookie("user");
           //      $curd=Curd::find($aa);
           //      $curd['pwd']=decrypt($curd['pwd']);
           //   //$aa=explode(",",$aa);
           //  // $zhang=$aa['0'];
           //  // $mima=$aa['1'];,['zhang'=>$zhang,'mima'=>$mima]
           // }else{
           //  $curd_name="";$pwd="";
           //  $curd=[$curd_name,$pwd];,['curd'=>$curd]
           // }
             //dd($curd);
            return view("admin.login.create");



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // encrypt 加密  decrypt 解密



       $a=request()->except(['_token','/Login/store']);
       // dd($a);
        $curd=Curd::where("curd_name",$a['name'])->first();
              //dd(decrypt($curd['pwd']));
            //dd(encrypt('wdan'));
            //dd($a['pwd']);
            //dd(encrypt($a['pwd']));
            if(decrypt($curd->pwd)!=$a['pwd']){
                return redirect("/Login/create")->with("msg","用户名或密码不正确,请查证后填写.");
            }
                //存session   
                
                //mima 检查是否勾选7天免登陆
                if(isset($a['mima'])){
                    //走到这里说明已经勾选             
                    Cookie::queue("user",serialize($curd),7*60*24);
                }

                //session(['curd'=>$curd]);
                request()->session()->put("curd",['name'=>$curd['curd_name'],'pwd'=>$curd['pwd']]);
                return redirect('/goods');
           // dd(request()->session()->get("curd"));
         
      
   
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
    }
    public function tc(){
        request()->session()->forget("curd");
        return redirect("/Login/create")->with("msg",",退出成功"); 
    }


}
