@extends('layouts.shop')
 @section('title', '登录页面')
   @section('content')
       <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form  class="reg-login"action="{{url('/loginto')}}"method="post" >
      @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text"name="user_name"  placeholder="输入手机号码或者邮箱号" />
             <span class="name"></span>         
       </div>
       <input type="hidden" name="refer" value="{{request()->refer}}">
       <div class="lrList"><input type="password"name="user_pwd"  placeholder="输入证码" />
            <span class="pwd"></span>
       </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button"class="button"  value="立即登录" />
      </div>
     </form><!--reg-login/-->
  <script>
  $(document).ready(function(){
      $(".button").click(function(){

        var name= $("input[name='user_name']").val();
        var pwd=$("input[name='user_pwd']").val();
        var refer=$("input[name='refer']").val();
        if(name==""){
          $(".name").html("<font color='red'>账号不可为空</font>");
        }
        if(pwd==""){
           $(".pwd").html("<font color='red'>密码不可为空</font>");
         } 
         $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
         $.post("/loginto",{user_name:name,user_pwd:pwd,refer:refer},function(res){
            if(res.code=='00005'){
              location.href="{{request()->refer}}";
            }


            if(res.code=='00001'){
                alert(res.msg);
                location.href="http://www.laravel.com";
            }else{
              alert(res.msg);
            }
         

         },'json');
      });
  });
   </script>
     @endsection