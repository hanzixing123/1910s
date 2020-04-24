@extends('layouts.shop')
 @section('title', '购物车')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
        @foreach($car as $k=>$v)
        @if($k==0)
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="boxs" name="1"  /> 全选</a></td>
       </tr>
        @endif
       <tr  id="{{$v->cart_id}}">
        <td width="4%"><input type="checkbox" class="box"    value="{{$v->cart_id}}"  name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('TUPIAN_URL')}}{{$v->img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->addtime)}}</time>
        </td>

        <td align="right" id="{{$v->cart_id}}"><input type="text" id="buy_{{$v->cart_id}}"  class="spinnerExample" /></td>
       
       </tr>
       <tr>
          <th colspan="4">
              小计:￥ <strong class="orange" id="xiaoji">{{$v->goods_price*$v->buy_num}}</strong>
              单价:￥ <strong class="orange" id="jiage">{{$v->goods_price}}</strong>
          </th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     

     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="zongjia"> ￥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
 <script>
//————————————————————————— 全选反选  —————————————————————————————————————————————
  $(document).ready(function(){
  $("#boxs").click(function(){
        var _this=$(this);   
      // 获取当前 复选框的状态  是否选中
      var boxs =_this.prop("checked");//返回值是 true 或 false
        $(".box").prop("checked",boxs);
        if(boxs==true){
            //表示全部被选中   //$("#zongjia").html("￥"+{{$totalprice}});
              zongjia();
        }else{
            //表示全部没有被选中
              $("#zongjia").html("￥"+0);
         // zongjia();
        }
   
      //alert(boxs);
  });
//—————————————————————————————  复选框 勾选 —————————————————————————
  $(document).on('click','.box',function(){
      var _this=$(this);
      var box=$(".box").prop('checked');
    
      zongjia();

  })
//—————————————————————————   减号      ——————————————————————————————————————————
  $(document).on("click",'.decrease',function(){
      var _this=$(this);  
        _this.parents("tr").find("td").find(".box").prop('checked',true);
        var buy_num=parseInt(_this.next().val());
        //var buy_num=buy_num-1;
        if(buy_num<=0){
            alert("至少购买一件商品....");
              _this.next().html(1);
          return false;
        }


       var goods_price=parseInt(_this.parents("tr").next().find("#jiage").html());
       //alert(goods_price); 
       var cart_id= _this.parents("td").prop("id");

      //alert(buy_num);prev
     // alert(cart_id);
          //传 方法 ajax  
       ajax(_this,buy_num,cart_id,goods_price);
       
  });
//—————————————————————————   加号      ——————————————————————————————————————————
$(document).on('click',".increase",function(){
  var _this=$(this);
   _this.parents("tr").find("td").find(".box").prop('checked',true);
  var buy_num=parseInt(_this.prev().val());
   var goods_price=parseInt(_this.parents("tr").next().find("#jiage").html());
       //alert(goods_price); 
       var cart_id= _this.parents("td").prop("id");
           //传 方法 ajax  
          ajax(_this,buy_num,cart_id,goods_price);
 

});
//————————————————————  文本框   ————————————————————————————————————————————————————————
  $(document).on('blur','.spinnerExample',function(){
      var _this=$(this);
         _this.parents("tr").find("td").find(".box").prop('checked',true);
        
      var buy_num=parseInt(_this.val());   
      var goods_price=parseInt(_this.parents("tr").next().find("#jiage").html());
      var cart_id= _this.parents("td").prop("id");
    //传 方法 ajax  
    ajax(_this,buy_num,cart_id,goods_price);
   
  });




//———————————————————————————    总价      ———————————————————————————————————————
  function zongjia(){
        //复选框勾选的数据
        var box=$('.box:checked');
        if(box.length==0){
          $("#zongjia").html("￥"+0);
          return false;
        }
        var moeny=0;
         box.each(function(index){
            var _this=$(this);
            var xiaoji=_this.parents("tr").next().find("#xiaoji").html();
              //去掉 ￥号
         // alert(xiaoji); 
             // xiaoji=xiaoji.substr(1,xiaoji.length);
               moeny+=Number(xiaoji);
               console.log(xiaoji);
         });
          
          $("#zongjia").html("￥"+moeny);
  }
//—————————————————————————  ajax   —————————————————————
  function  ajax(_this,buy_num,cart_id,goods_price){
      $.get('/jiajian',{buy_num:buy_num,cart_id:cart_id},function(res){
            if(res.code=='1'){
              _this.parents("tr").next().find("#xiaoji").html(buy_num*goods_price);
               zongjia();
            }
      },'json');
  }


  $(".jiesuan").click(function(){
         box= $(".box:checked");
         //alert(box);
         //console.log(box);
        if(box.length==0){
          alert("请至少勾选一件商品进行结算....");
          return false;
        }
          var cart_id='';
          box.each(function(index){
               cart_id+=$(this).parents('tr').prop("id")+',';
            //console.log(cart_id);
         
          })
           var goods_id=cart_id.substr(0,cart_id.length-1);
          console.log(goods_id);//"/login?refer="+window.location.href;
          location.href="cardel/"+goods_id;


  })




});//加载事件括号
 </script>

   @endsection