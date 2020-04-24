<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 登录页面</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<center><font color='red'><h2>登录页面</h2></font></center>
<form class="form-horizontal" role="form" action="{{url('Login/store')}}" method="post">
	@csrf
	<div class="form-group has-success">
		<label class="col-sm-1 control-label" for="inputSuccess">
			用户名
		</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" value=""  id="inputSuccess"placeholder="请输入用户名">
		</div>
	</div>
	<div class="form-group has-warning">
		<label class="col-sm-1 control-label" for="inputWarning">
			密码
		</label>
		<div class="col-sm-10"> 
			<input type="password" class="form-control" value=""  name="pwd" id="inputWarning"placeholder="请输入密码">
		</div>
	</div>

		<div class="form-group has-warning">
		<label class="col-sm-1 control-label" for="inputWarning">
			记住密码
		</label>
		<div class="col-sm-1"> 
			<input type="checkbox" class="form-control" name="mima"  value="1" id="inputWarning">
		</div>
	</div><center><b><h2 style="color:red">{{session('msg')}}</h2></b></center>		

		<div class="form-group has-success">
		<label class="col-sm-1 control-label" for="inputSuccess">
			<input type="submit" class="btn btn-info btn-lg" value="登录">
		</label>
	</div>
</form>

</body>
</html>