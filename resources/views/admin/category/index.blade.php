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
	<center><h2><font color='red'>分类列表</font><h2> 
	<a href="{{url('/category/create')}}" type="button" class="btn btn-info btn-lg"><font color='black'>添加新分类</font></a> 
		
	</center>
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
			<th>所属分类(父类ID)</th>
			<th>相关介绍</th>
			<th>是否在导航栏展示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($category as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat("|——>",$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->parent_id}}</td>
			<td>{{$v->cate_desc}}</td>
			<td>@if($v->is_show_nav==1)<font color='red'><h3>√</h3></font>@else<font color='red'><h3>×</h3></font>@endif           </td>
		
			<td><a href="{{url('/category/destroy/'.$v->cate_id)}}"   type="button"class="btn btn-info btn-lg"><font color='red'>删除</font></a> 

				 <a href="{{url('/category/edit/'.$v->cate_id)}}"  type="button"class="btn btn-info btn-lg">修改</a></td>
		</tr>
		@endforeach
		
	</tbody>
</table>
		

</body>
</html>