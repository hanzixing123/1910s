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
        </ul>
    </div>
   		<div class="navbar-header" style="padding-top:15px;float:right;color:#fff">
   			 欢迎【<font color='green'>{{session('curd')->curd_name}}</font>】登录
    </div>
	</div>
</nav>
	<!-- 导航栏 -->
<a href="{{url('/Login/tc')}}" type="button" class="btn btn-info btn-lg">
	<font color='black'>退出</font></a> 
		


<!--按钮的css -->
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> 
<table class="table table-striped">
	<center><h2><font color='red'>品牌列表</font><h2> 
	<a href="{{url('/brand/create')}}" type="button" class="btn btn-info btn-lg"><font color='black'>添加新品牌</font></a> 
	<form>
	<input type="text"name="brand_name"value="{{$brand_name}}"placeholder="请输入品牌名称关键字">
	<input type="submit"class="btn btn-info btn-lg" value="搜索">
	</form>
	</center>
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌LOGO</th>
			<th>品牌详情</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>@if($v->brand_logo)<img width="100"    src="{{env('TUPIAN_URL')}}{{$v->brand_logo}}">@endif</td>
			<td>{{$v->brand_desc}}</td>
			<td><a href="{{url('/brand/destroy/'.$v->brand_id)}}"   type="button"class="btn btn-info btn-lg"><font color='red'>删除</font></a> 

				 <a href="{{url('/brand/edit/'.$v->brand_id)}}"  type="button"class="btn btn-info btn-lg">修改</a></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6"align="center">{{$brand->appends(['brand_name'=>$brand_name])->links() }}</td>
		</tr>
	</tbody>
</table>

<script>
	$(document).on('click',".page-item a",function(){
		var _this=$(this);
		var url=_this.attr("href");
		//alert(url);
		$.get(url,function(res){
			$("tbody").html(res);
		});
		return false;
	});

</script>


</body>
</html>