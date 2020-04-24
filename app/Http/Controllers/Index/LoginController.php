<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;//邮件发送时用的
use Illuminate\Support\Facades\Mail;//邮件发送时用的
use App\Userss;
class LoginController extends Controller
{

		//登录页面
  	 public  function login(){
  	 	     dump(request()->session()->get('user'));
    	return view("index.login");
    }
    	//注册页面
	public function reg(){
		//dump(session('code'));//die;
    	return view("index.reg");
    }



    //手机号验证处理
    public function sendSms(request $request){
    	$moblie=$request->moblie;
    	$reg='/^1[3|5|6|7|8|9]\d{9}$/';
    	if(!preg_match($reg,$moblie)){
    		echo json_encode(['code'=>'00001','msg'=>"手机号格式不正确"]);die;
    	}
    	$code=rand(100000,999999);
    	$res=$this->sendByMoblie($code,$moblie);

    	//dd($res);
    	if($res['Message']=='OK'){
    			session(["code"=>$code]);
    			request()->session()->save();
			echo json_encode(['code'=>'00000','msg'=>"发送成功"]);die;
    	}
   

    }
     //邮箱验证处理
    public function sendEmail(request $request){
    		//接值
    		$email=request()->email;
    		//验证邮箱是否正确
    		$emailreg='/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,3}$/';
    		if(!preg_match($emailreg,$email)){
    			//走到这里说明邮箱格式不正确
    			echo json_encode(['code'=>'00001','msg'=>"邮箱格式不正确!!!"]);die; 			
    		}

    		//dd($email);
    		$code=rand(100000,999999);
    		$res=$this->sendByEmail($code,$email);
			  //存入session
			    session(["code"=>$code]);
			    request()->session()->save();
			    echo json_encode(['code'=>'00001','msg'=>"发送成功"]);die;
    }



    	//  执行注册
    public function useradd(request $request){
    
    	$res=request()->except('/useradd');
          // dd($res);
    		$kk=request()->only(['user_name','user_pwd']);
                //介绍session中的验证码
                $session=request()->session()->get('code');
                //判断session中的验证码是否与填写的一致
                if($session!=$res['code']){
                 echo json_encode(['code'=>'00000','msg'=>"验证码不正确"]);die;
                }
            $user=Userss::where('user_name',$kk['user_name'])->count();
            if($user){
               echo json_encode(['code'=>'00000','msg'=>"该用户已存在"]);die; 
            }

			$kk['user_pwd']=encrypt($kk['user_pwd']);
    		$add=Userss::insert($kk);
    		//dd($kk);
    			

    		if($add){
    			echo json_encode(['code'=>'00001','msg'=>"注册成功"]);die;
    		}
    		//dd($res);
    }
    	//执行登录
    	public function loginto(request $request){

            $zhi=request()->except('/loginto');
           // $zhang=request()->user_name;//接收输入的手机号或邮箱
            //$mi=request()->user_pwd;//接收密码
            $mi=$zhi['user_pwd'];
             //dd($mi);
            $user=Userss::where('user_name',$zhi['user_name'])->get();//查询单条数据查看是否有该值
            if(empty($user)){//当不存在该数据是终止返回登录页面
                echo json_encode(['code'=>'00000','msg'=>'该用户不存在！！']);die;
            }

            $mia='';
            foreach($user as $k=>$v){
                $mia=  decrypt($v['user_pwd']);
            }
            if($mi!==$mia){
                  echo json_encode(['code'=>'00000','msg'=>"账号或密码不匹配"]);die;
            }
           
            session(['user'=>$zhi['user_name']]);
                request()->session()->save();
                if($zhi['refer']){
                    echo json_encode(['code'=>'00005','msg'=>"登录成功,正在前往商品详情页面"]);die;
                    //return redirect($zhi['refer']);
                }
                echo json_encode(['code'=>'00001','msg'=>"登录成功"]);die;

    	}

    //   public function check_dl(){
    //         $zhang=input("zhang");//接收输入的手机号或邮箱
    //         $pwd=input("pwd");//接收密码
    //         $remember_me=input("remember_me");//接收查看是否有勾选记住密码
    //         //echo $zhang,$pwd,$remember_me;die;
    //             //substr_count 判断 “ @ ”出现次数  
    //         if(substr_count($zhang,"@")>0){ //判断是手机号或邮箱
    //                         //通过判断确认是邮箱登录
    //             $where=[ ["user_email",'=',$zhang  ] ];
    //         }else{
    //                         //通过判断确认是手机号登录
    //             $where=[ ["user_tel","=",$pwd      ] ];
    //         }
                
    //             $user_model=new userModel;//实例化model
    //             $user=$user_model->where($where)->find();//查询单条数据查看是否有该值
    //             if(empty($user)){//当不存在该数据是终止返回登录页面
    //                 echo returnjson(1,"该用户不存在");
    //                 die;
    //                 }
    //             $time=time();//当前时间
    //             $error_num=$user['error_num'];//错误次数
    //             $error_time=$user['error_time'];//错误时间
    //             if(!empty($user)){

     
    //             if($user['user_pwd']==md5($pwd)){ 
    //                 //-----------------------------------验证账号是否已锁定，已锁定时间是否已到已解封时间
    //                             //判断当密码错误三次，而且解封时间还未到时，提示账号锁定中
    //                 if($error_num>=3&&$time-$error_time<3600){
    //                     $min=60-ceil(($time-$error_time)/60);
    //                     echo returnjson(1,"账号锁定中...请".$min."分钟后重新登录");
    //                     die;
    //                     }
    //                 //-----------------------------------------------
    //                     $user_model->where($where)->update(['error_num'=>0,'error_time'=>0]);
    //                 //存入session 
    //             session("user",["user_id"=>$user['user_id'],
    //             'user_zhang'=>$zhang,'user_pwd'=>$pwd]);
    //             //判断是否已勾选，勾选传入cookie 记住密码存10天
    //             if($remember_me=='true'){
    //                     cookie("user_lzy",['user_zhang'=>$zhang,'user_mima'=>$pwd],60*60*14*10);
    //                 }  //  判断是否已勾选，勾选传入cookie 记住密码存10天
    //                     //账号密码正确而且账号没有封锁则登录成功
    //                 //—————————————同步未登录的浏览记录————————————————————————————
    //                 $this->asyncHistory();
    //                 //——————————————同步购物车的信息——————————————
    //                 $this->asyncCart();
    //                     echo    returnjson(0,"登录成功"); 

    //                         die;
    //                 }else{
    //                 //当前是密码错误的分支

                        
    //                     //-----------------------------------------------------------------------------
    //                     if($error_num>=3){
    //                     //当错误大于等于3次时
    //                         //---------------------------------------------------
    //                         if($time-$error_time>3600){
    //                         //当前分支是密码错误已有三次但是已到解封时间
    //                             $user_model->where($where)->update(['error_num'=>1,'error_time'=>$time]);
    //                             echo returnjson(1,"密码错误还有2次机会");
    //                                 die;
    //                         }else{
    //                             //当前分支是密码错误已有三次但是未到解封时间
    //                             $min=60-ceil(($time-$error_time)/60);
    //                             echo returnjson(1,"账号锁定中,请在$min分钟后重新登录 ");
    //                             die;
    //                         }
    //                         //---------------------------------------------------------
    //                     }else{
    //                     //当前分支是密码错误次数小于3
    //                             $error_num=$error_num+1;// 库里密码错误次数加一
    //                             $user_model->where($where)
    //                                        ->update(['error_num'=>$error_num,'error_time'=>$time]);
    //                                 //--------------------------------------------------------------
    //                             if($error_num>=3){
    //                                 //当前分支是密码错误次数等于3时
    //                                 echo returnjson(1,"账号已锁定,请在60分钟之后重新登录");
    //                                 die;
    //                             }else{
    //                                 //当前分支是密码错误次数小于3时，
    //                                 $num=3-$error_num;
    //                                 //提醒用户还有几次机会
    //                                 echo returnjson(1,"密码错误,还有".$num."次机会");
    //                                     die;
    //                             }
    //                             //---------------------------------------------------------------------

    //                     }
    //                     //-----------------------------------------------------------------------------


    //                 }

    //              }
    // }
















    	//邮件发送
    public function sendByEmail($code,$email){
    	Mail::to($email)->send(new SendCode($code));

    }




    	//手机号 发送
    public function sendByMoblie($code,$moblie){


			// Download：https://github.com/aliyun/openapi-sdk-php
			// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

			AlibabaCloud::accessKeyClient('LTAI4GKtZYDDSLpmhQwqoQ4h', 'F5rVBJZE9D0Sddd8NS2zBMX1dW8Eve')
			                        ->regionId('cn-hangzhou')
			                        ->asDefaultClient();

			try {
			    $result = AlibabaCloud::rpc()
			                          ->product('Dysmsapi')
			                          // ->scheme('https') // https | http
			                          ->version('2017-05-25')
			                          ->action('SendSms')
			                          ->method('POST')
			                          ->host('dysmsapi.aliyuncs.com')
			                          ->options([
			                                          'query' => [
			                                          'RegionId' => "cn-hangzhou",
			                                          'PhoneNumbers' => $moblie,
			                                          'SignName' => "恒恒小院",
			                                          'TemplateCode' => "SMS_185230333",
			                                          'TemplateParam' =>"{code:$code}",
			                                        ],
			                                    ])
			                          ->request();
			     return $result->toArray();
			} catch (ClientException $e) {
			    return $e->getErrorMessage() . PHP_EOL;
			} catch (ServerException $e) {
			    return $e->getErrorMessage() . PHP_EOL;
			}

			    }





}
