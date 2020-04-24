<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Curd;
use App\Http\Requests\StoreCurdPost;
use Validator;//第三种
use Illuminate\Validation\Rule;//第三种
class CurdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $curd_name=request()->curd_name;
        //dd($curd_name);
        if($curd_name!==""){
           $where[]=["curd_name","like","%$curd_name%"];
        }



         $pageSize=config("app.pageSize");
            $list=Curd::where($where)->paginate($pageSize);
            //dd(encrypt("123"));

            //$list->pwd=decrypt($list->['pwd']);
             //dd($list);//dd($list);

            return view("admin.curd.index",['list'=>$list,"curd_name"=>$curd_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
           return view("admin.curd.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurdPost $request)
    {
        //
        $post=request()->except(['_token','/curd/store']);
       
        // session
        $post['pwd']=encrypt($post['pwd']);
        $post['time']=time(); //dd($post);
        $res=Curd::insert($post);
        if($res){
              request()->session()->put("curd",["name"=>$post['curd_name'],"pwd"=>$post['pwd']]);  
             //dump(request()->session()->get("curd"));
            return redirect("/curd");
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
        //
        $res=Curd::find($id);
        $res['pwd']=decrypt($res['pwd']);
        if($res){
           return view("admin.curd.edit",['res'=>$res]);
        }
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
                $post=$request->except(['_token','/curd/update/'.$id]);
            
         $validaor=Validator::make($post,[  // 排除自身ID //unique 里写表名
            'curd_name'=>["required",Rule::unique("curd")->ignore($id,'curd_id'),
            "regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{0,18}$/u"
            ],
            "tel"=>"required|regex:/^[1][3,4,5,7,8][0-9]{9}$/u",
            "email"=>"required|regex:/^[0-9a-zA-Z]{6,}@qq.com$/",
            "pwd"=>"required|regex:/^[0-9a-zA-Z]{6,}$/",
        ],[
            "curd_name.required"=>"用户名称不可为空",
            "curd_name.unique"=>"用户名称已存在",
            "curd_name.regex"=>"用户名称必须是汉字而且在2位到10位之间",
            "tel.required"=>"用户手机号不可为空",
            "tel.regex"=>"必须是正确手机号,必须以13,14,15,17,18,为开头,而且必须是11位!!!!",
            "email.required"=>"邮箱不可为空",
            "email.regex"=>"邮箱格式不正确",
            "pwd.required"=>"密码不可为空",
            "pwd.regex"=>"密码格式不正确",
             ]);
            if($validaor->fails()){//有错走这个判断
                   return redirect("curd/edit/".$id)->withErrors($validaor)->withInput();
            }
            $post['time']=time();
            $post['pwd']=encrypt($post['pwd']);
             $res=curd::where("curd_id",$id)->update($post);

            if($res!==false){
                return redirect("/curd");
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
        $res=Curd::destroy($id);
        if($res){
            request()->session()->forget("curd");
            return redirect("/curd");
        }
    }
}
