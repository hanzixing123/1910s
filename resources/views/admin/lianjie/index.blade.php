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
	<center><h2><font color='red'>用户列表</font></h2> 
	<a href="{{url('/lianjie/create')}}" type="button" class="btn btn-info btn-lg"><font color='black'>
		添加新用户</font></a> 
	</center>
	<form>
	网站名称:<input type="text"name="mingcheng"value="{{$mingcheng ??'' }}">
	 <input type="radio"name="radio"  value="1" {{$radio == 1 ? "checked" : '' }}>LOGO连接
	<input type="radio" name="radio"  value="0" {{$radio == 0 ? "checked" : '' }}>文字连接


		<input type="submit"value="搜索">

	</form>

	<thead>
		<tr>
			<th>网站ID</th>
			<th>网站名称</th>		
			<th>网站地址</th>
			<th>类型</th>
			<th>图片</th>
			<th>联系人</th>
			
			<th>是否显示</th><th>介绍</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($all as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->url}}</td>
			<td>{{$v->radio==1?'LOGO连接':'文字连接'}}</td>
			<td><img  width="200" src="{{env('TUPIAN_URL')}}{{$v->img}}"></td>		
			<td><font color='red'>{{$v->desc}}</font></td>		
			<td><font color='red'>{{$v->is_del==1?'是':'否'}}</font></td>	
			<td><font color='red'>{{$v->Contact}}</font></td>	
			<td><button class="btn btn-info btn-lg kkkkkk" id="{{$v->id}}"><font color='red'>删除</font></a> </button>
				
				
				 <a href="{{url('/lianjie/edit/'.$v->id)}}"  type="button"class="btn btn-info btn-lg">
				 	修改</a></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6"align="center">{{$all->appends([$mingcheng,$radio])->links()}}</td>
		</tr>
	</tbody>
</table> 


<script>
	$(document).on('click','.page-item a',function(){
		var url=$(this).attr("href");
		$.get(url,function(res){
		//	alert(res);
		$("tbody").html(res);
		});
		return false;
	});
	$(".kkkkkk").click(function(){
		var id=$(this).prop('id');
	
		// $.get(
		// 	url:"{{url('lianjie/destroy')}}",
		// 	data:{id:id},
		// 	function(res){
		// 	alert("成功");
		// })
	 location.href="{{url('lianjie/destroy/')}}/"+id;

	});


</script>
</body>
</html>