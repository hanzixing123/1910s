<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;
        //定义成员变量
        public  $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */                         //接受初始值,并赋贵成员变量
    public function __construct($code)
    {
        //成员变量
        $this->code=$code;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {                                    //邮件主题             // 邮件模板视图          //验证码 
        return $this->subject("全国最扯的批发商城验证码")->view('index.sendcode',['code'=>$this->code]);
    }
}
