<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 表单控件状态</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类表</title>
	<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="//cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</nav></head>
<body>
	<!-- 导航栏 -->
		<center><h2><font color='red'>用户添加页面</font></h2>
<a href="{{url('/curd')}}" type="button" class="btn btn-info btn-lg"><font color='black'>用户列表</font></a>
		</center><br>

<form class="form-horizontal" role="form" action="{{url('/curd/store')}}" method="post">
	@csrf
	<div class="form-group has-success">
		<label class="col-sm-2 control-label" for="inputSuccess">
			用户名称:
		</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"   name="curd_name" id="inputSuccess" placeholder="请输入用户名称">	<b><font color='red'><h4>{{$errors->first('curd_name')}}</h4></font></b>
		</div>

	</div>
	
	<div class="form-group has-warning">
		<label class="col-sm-2 control-label" for="inputWarning">
			手机号:
		</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="tel"  id="inputWarning" placeholder="请输入手机号"><b><font color='red'><h4>{{$errors->first('tel')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group has-error">
		<label class="col-sm-2 control-label" for="inputError">
			email:
		</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="email" id="inputError" placeholder="请输入email">
			<b><font color='red'><h4>{{$errors->first('email')}}</h4></font></b>
		</div>
	</div>
		<div class="form-group has-error">
		<label class="col-sm-2 control-label" for="inputError">
			密码:
		</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="pwd" id="inputError" placeholder="请输入密码">
			<b><font color='red'><h4>{{$errors->first('pwd')}}</h4></font></b>
		</div>
	</div>
	<center><input type="submit" class="btn btn-info btn-lg" value="点击添加新用户"></center>
</form>
</body>
</html>