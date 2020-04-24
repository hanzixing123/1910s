<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // session(['curd'=>null]);
        // request()->session()->save();
       // dd(11);
        //判断是否登录
         $a= request()->session()->get("curd");
        if(!$a){
            //  从cookie中取用户信息,如果有则 并存入session
            $cookiecurd=request()->cookie("user");
            if($cookiecurd){
                // dd(11);
                session(['curd'=>unserialize($cookiecurd)]);
            }else{
        return redirect("/Login/create");
              }
        }
        return $next($request);
    }
}
