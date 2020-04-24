<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- 导航栏 -->
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<meta name="csrf-token" content="{{csrf_token()}}">

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li class="active<"><a href="{{url('/brand')}}">商品品牌</a></li>
            <li><a href="{{url('/category')}}">商品分类</a></li>
            <li><a href="{{url('/goods')}}">商品管理</a></li>
            <li><a href="{{url('/curd')}}">管理员管理</a></li>
            <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Java <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">jmeter</a></li>
                    <li><a href="#">EJB</a></li>
                    <li><a href="#">Jasper Report</a></li>
                    <li class="divider"></li>
                    <li><a href="#">分离的链接</a></li>
                    <li class="divider"></li>
                    <li><a href="#">另一个分离的链接</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
	</div>
</nav>
	<!-- 导航栏 -->




<!--按钮的css -->
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> 
<table class="table table-striped">
	<center><h2><font color='red'>商品列表</font></h2> 
	<a href="{{url('/goods/create')}}" type="button" class="btn btn-info btn-lg"><font color='black'>添加商品	</font></a> 
<h3><form action="">
		商品名称: <input type="text"name="goods_name"value="{{$query['goods_name'] ??''}}">
		商品品牌: 
		<select name="brand_id">
			<option value="">请选择品牌</option>
			@foreach($brand as $v)
			<option value="{{$v->brand_id}}"@if(isset($query['brand_id']) && $v->brand_id==$query['brand_id'])selected @endif>{{$v->brand_name}}</option>
			@endforeach
		</select>
		商品分类:
		<select name="cate_id">
			<option value="">请选择品牌</option>
			@foreach($cate as $v)
			<option value="{{$v->cate_id}}"@if(isset($query['cate_id']) && $v->cate_id==$query['cate_id'])selected  @endif>
				{{str_repeat('|——>',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
		</select>
		<button>搜索</button>
	</form></h3>
	</center>
	
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>品牌名称</th>
			<th>所属分类</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>图片</th>
			<th>图集</th>
			<th>是否前台幻灯片推荐</th>
			<th>商品详情</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goods as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td><font color='red'>{{$v->goods_no}}</font></td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
		
			<td><font color='blue'><h3>{{$v->is_new==1?"√":"×"}}</h3></font></td>

			<td><font color='blue'><h3>{{$v->is_dest==1?"√":"×"}}</h3></font></td>
			<td><font color='blue'><h3>{{$v->is_up==1?"√":"×"}}</h3></font></td>
			<td>@if($v->img)<img width="100"    src="{{env('TUPIAN_URL')}}{{$v->img}}">@endif</td>
				<td>@if(isset($v->imgs))
				@php $imgs=explode('|',$v->imgs);@endphp
				@foreach($imgs as $vv)
			<img width="100"    src="{{env('TUPIAN_URL')}}{{$vv}}">	
				@endforeach				
				@endif</td>
				<td>{{$v->is_silde==1?"√":"×"}}</td>
			<td>{{$v->goods_desc}}</td>
			<td><a href="{{url('/goods/destroy/'.$v->goods_id)}}"  type="button"class="btn btn-info btn-lg"><font color='red'>删除</font></a> 

				 <a href="{{url('/goods/edit/'.$v->goods_id)}}"  type="button"class="btn btn-info btn-lg">修改</a></td>
		</tr>
		@endforeach
		<tr>
		<td colspan="6"align="center">{{$goods->appends($query)->links()}}</td>	
		</tr>	
	</tbody>
</table>
<script>
	$(document).on("click",".page-item a",function(){
		var url=$(this).attr("href");

		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr("content")}});	
		$.post(url,function(res){
			$("tbody").html(res);
		});
		return false;






		//alert("KK");
		// $.ajax({
		// 		url:"{{url('/goods')}}",
		// 		data:{url:url},
		// 		type:"get",
		// 		success:function(res){
		// 			$("tbody").html(res);
		// 		}
		// 	});
		// 	return false;
	});

</script>
</body>
</html>