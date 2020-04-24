<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 表单控件状态</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  	<!-- 导航栏 -->
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
	</div>
</nav></head>
<body>
	<!-- 导航栏 -->	
			<center><h2><font color='red'>网站连接添加页面</font></h2>
<a href="{{url('/lianjie')}}" type="button" class="btn btn-info btn-lg"><font color='black'>用户列表</font></a>
		</center><br>
<form class="form-horizontal" role="form" action="{{url('lianjie/update')}}/{{$res->id}}"method="post"enctype="multipart/form-data">
	@csrf
	<div class="form-group has-success">
		<label class="col-sm-1 control-label" for="inputSuccess">
			网站名称
		</label>
		<div class="col-sm-10">
			<input type="text" name="name" value="{{$res->name}}" class="form-control" id="inputSuccess">
			<b><font color='red'><h4>{{$errors->first('name')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group has-warning">
		<label class="col-sm-1 control-label" for="inputWarning">
			网站地址
		</label>
		<div class="col-sm-10">
			<input type="text"name="url" value="{{$res->url}}"  class="form-control" id="inputWarning">
			<b><font color='red'><h4>{{$errors->first('url')}}</h4></font></b>
		</div>
	</div>
		<div class="form-group has-warning">
			<label class="col-sm-1 control-label" for="inputWarning">
			连接类型 
		</label>
	<input type="radio" name="radio" value="1"@if($res['radio']==1) checked @endif >LOGO连接		
	<input type="radio" name="radio" value="0"@if($res['radio']==0) checked @endif >文字连接		
	</div>
	<div class="form-group has-error">
		<label class="col-sm-1 control-label" for="inputError">
			网站LOGO
		</label>
		<div class="col-sm-10">
			<img src="{{env('TUPIAN_URL')}}{{$res->img}}" width="200">
			<input type="file"name="img" value=""  class="form-control" id="inputError">
		</div>
	</div>

	<div class="form-group has-error">
		<label class="col-sm-1 control-label" for="inputError">
			网站联系人
		</label>
		<div class="col-sm-10">
			<input type="text"name="Contact" value="{{$res->Contact}}"  class="form-control" id="inputError">
			<b><font color='red'><h4>{{$errors->first('Contact')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group has-error">
		<label class="col-sm-1 control-label" for="inputError">
			网站介绍
		</label>
			<textarea name="desc" id="" cols="130" rows="10">{{$res->desc}}</textarea>

	</div>
	<b><font color='red'><h4>{{$errors->first('desc')}}</h4></font></b>
	<div class="form-group has-warning">
			<label class="col-sm-1 control-label" for="inputWarning">
			连接类型 
		</label>
	<input type="radio" name="is_del" value="1"@if($res['is_del']==1) checked @endif >是		
	<input type="radio" name="is_del" value="0"@if($res['is_del']==0) checked @endif >否			
	</div>
<input type="submit" class="btn btn-info btn-lg" value="修改连接">
</form>

</body>
</html>