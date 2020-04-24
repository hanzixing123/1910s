<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类表</title>
	<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="//cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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



		<center><h2><font color='red'>分类编辑页面</font></h2>
<a href="{{url('/category')}}" type="button" class="btn btn-info btn-lg"><font color='black'>分类列表</font></a>
		</center>
<form role="form" action="{{url('/category/update/'.$cate->cate_id)}}"method="post">
	  @csrf
	<div class="form-group">
		<h3><font color='red'>分类名称↓</font></h3>
		<input class="form-control input-lg" name="cate_name" value="{{$cate->cate_name}}" type="text" placeholder="请输入分类名称">
	</div>
	<div class="form-group">
		<h3><font color='red'>父分类↓</font></h3>
		<select class="form-control input-lg" name="parent_id">
			<option value="0">顶级分类</option>
			@foreach($aa as $v)
			<option value="{{$v->cate_id}}"@if($v->cate_id==$cate->parent_id)selected @endif>{{str_repeat('|——>',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
		</select>
	</div>
	

	<div class="form-group">
		<font color='red'>是否导航显示</font>
		<input type="radio" name="is_show_nav"value="1"checked>是	
		<input type="radio" name="is_show_nav"value="0">否
	</div>


	<div class="form-group">
		<h3><font color='red'>分类简介↓</font></h3>
				<textarea name="cate_desc"  cols="200" rows="10">{{$cate->cate_desc}}</textarea>
	</div>
	<input type="submit" class="btn btn-info btn-lg" value="点击:确定编辑">
</form>

</body>
</html>
