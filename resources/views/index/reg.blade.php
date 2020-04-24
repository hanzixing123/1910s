@extends('layouts.shop')
 @section('title', '注册页面')
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
     <form action="{{url('')}}" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name"   placeholder="输入手机号码或者邮箱号" /></div>
        <span class="name"></span>
       <div class="lrList2"><input type="text"  name="code"  placeholder="输入短信验证码" /> <button type="button"class="yanzheng" >获取验证码</button></div>
       <span class="code"></span>
       <div class="lrList"><input type="text" name="password"    placeholder="设置新密码（6-18位数字或字母）" /></div>
         <span class="spanpwd"></span>
       <div class="lrList"><input type="text" name="passwords"    placeholder="再次输入密码" /></div>
      <span class="spanpwds"></span>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" class="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->

    <script>
      //加载事件
 $(document).ready(function(){
      //验证手机号 
//—————————————————— 验证码 手机号————————————————————————————————————————————————————————————————
      
      $(".yanzheng").click(function(){      
          //输入的手机号
        var name=$('input[name="name"]').val();
          //手机号格式
        var reg=/^1[3|5|6|7|8|9]\d{9}$/;
          //说明 输入的手机号，符合正则
        if(reg.test(name)){
                //用post请求的时候需要的代码
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
                //post提交  
                $.post('/sendSms',{moblie:name},function(res){
                //调回返回参数
                alert(res.msg);
                 },'json');
            return;
           }
//—————————————————— 验证码 邮箱————————————————————————————————————————————————————————————————
           var Emailreg=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,3}$/;
           if(Emailreg.test(name)){
            $.get('/sendEmail',{email:name},function(res){
                alert(res.msg);
            },'json');
           return;
           }
           alert("请输入正确的手机号或邮箱");

          });
//——————————————————   验证密码 ————————————————————————————————————————————————————————————————
    
      $("input[name='password']").blur(function(){
            var _this=$(this);
            //输入的密码
          var name=$(this).val();
            //密码格式 必须在8位以上
          var reg=/^\w{6,18}$/;
          if(!reg.test(name)){
              //alert("kk");
              $(".spanpwd").html("<font color='red'>密码格式错误</font>");
            return false;
          }else{
            $(".spanpwd").html("<font color='blue'>√</font>");
          }
       

         });        
//————————————————————— 确定密码 —————————————————————————————————————————————————————————————
  $("input[name='passwords']").blur(function(){
        //确定密码输入的值
         var pwds=$(this).val();
        //密码输入的值
         var pwd=$("input[name='password']").val();
         if(pwds==""){
               $(".spanpwds").html("<font color='red'>确认密码不可为空</font>");
         }else if(pwd!==pwds){
              $(".spanpwds").html("<font color='red'>密码和确认密码不匹配</font>");
         }else{
             $(".spanpwds").html("<font color='blue'>√</font>");
         }


  });
//—————————————————————————————— 发送数据  —————————————————————————————————————————————————————
  $(".submit").click(function(){
      

        var name=$('input[name="name"]').val();
 //————————— 手机号 ————————————————————————
      
          //说明 输入的手机号，符合正则
        if(name==""){
          $(".name").html("<font color='red'>不可为空！</font>");return false;
        }   
//————————— 邮箱 ————————————————————————
              //手机号格式
           var reg=/^1[3|5|6|7|8|9]\d{9}$/;
           var Emailreg=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,3}$/;
           if(!Emailreg.test(name)&& !reg.test(name)){
                    $(".name").html("<font color='red'>请输入邮箱或手机的正确格式</font>"); return false;
           }   
  //—————————————————————— 密码 ————————————————————————
       var pwdreg=/^\w{6,18}$/;
          var pwd=$("input[name='password']").val();//密码
          var pwds=$("input[name='passwords']").val();//确定密码
        if(!pwdreg.test(pwd)){
                $(".spanpwd").html("<font color='red'>密码格式错误</font>");return false;
        }else if(pwd!==pwds){
           $(".spanpwds").html("<font color='red'>密码和确认密码不匹配</font>");return false;
        }else{
          if(pwd==""){
            $(".spanpwd").html("<font color='red'>密码不可为空</font>");return false;
          }
          if(pwds==""){
            $(".spanpwds").html("<font color='red'>确定密码不可为空</font>");return false;
          }
        }
      //—————————————————————— 验证码 ————————————————————————
        var codereg=/^[0-9]{6}$/;
        var code=$("input[name='code']").val();//验证码
        if(!codereg.test(code)){
            $(".code").html("<font color='red'>验证码为6位纯数字</font>");return false;
        }
        if(code==''){
          $(".code").html("<font color='red'>验证码不可为空</font>");return false;
        }
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
        $.post("/useradd",{user_pwd:pwd,pwds:pwds,code:code,user_name:name},function(res){
            alert(res.msg);
        },'json');



  });






 });
    



    </script>
        @endsection