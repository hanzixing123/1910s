@extends('layouts.shop')
 @section('title', '商品详情')
    @section('content')



<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     

      @if(isset($res->imgs))
        @php $imgs=explode('|',$res->imgs);@endphp
        @foreach($imgs as $vv)
      <img width="100"    src="{{env('TUPIAN_URL')}}{{$vv}}"> 
        @endforeach $foreach($res->imgs as $vv )$ecdforeach;      
        @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$res->goods_price}}</strong></th>
       <td>
        <input type="text" name="buy_num" id="buy_num"  class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$res->goods_name}}</strong>
        <p class="hui">{{$res->goods_desc}}
          <b style="">  当前点击量为:{{$num}}<b>
        </p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('TUPIAN_URL')}}{{$res->img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th><!-- {{url('/car/'.$res->goods_id)}} -->
       <td><a  class="addcar" href="javascript:;">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <script>

    $(document).ready(function(){
      //加入购物车
    $(".addcar").click(function(){
      var goods_id={{$res->goods_id}};
      var buy_num=$('#buy_num').val();
        if(buy_num<1){
            alert("购买数量不能低于一件");return false;
        }
        $.get('/addcar',{goods_id:goods_id,buy_num:buy_num},function(res){
          alert(res.msg);
        
          //走此说明没有登录
          if(res.code=='00002'){
            location.href="/login?refer="+window.location.href;
            //走此说明出现错误
          }else if(res.code=='00001'){
            alert(res.msg);return false;
          }else{
            location.href="/car";
          }
},'json');


        });

    //减
    //     $(".decrease").click(function(){
    //           var buy_num=  $("#buy_num").val();
    //             if(buy_num<1){
    //               alert("购买数量不能小于一件商品");
    //               $('#buy_num').val(1);
    //               return false;
    //             }
    //             //var goods_price=$(".orange").text();
    //             //trim(goods_price,'￥');
    //            // alert(goods_price);
    //         })
    // //加
    //     $(".increase").click(function(){
                
    //        })

     })
    </script>
    @endsection




