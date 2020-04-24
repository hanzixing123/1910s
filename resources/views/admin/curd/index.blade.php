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
	<a href="{{url('/curd/create')}}" type="button" class="btn btn-info btn-lg"><font color='black'>
		添加新用户</font></a> 
	</center>
	<form>
		<h3 colspan="6" style="color:red;background:green">用户名:<input type="text" name="curd_name" value="{{$curd_name}}" style="color:red; background:orange" placeholder="请输入用户名"class="btn btn-lg" >
		<input type="submit"class="btn btn-info btn-lg" value="搜索"></h3>    
	</form>

	<thead>
		<tr>
			<th>用户ID</th>
			<th>用户名称</th>		
			<th>手机号</th>
			<th>email</th>
			<th>密码</th>
			<th>时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $v)
		<tr>
			<td>{{$v->curd_id}}</td>
			<td>{{$v->curd_name}}</td>
			<td>{{$v->tel}}</td>
			<td>{{$v->email}}</td>
			<td>{{decrypt($v->pwd)}}</td>		
			<td><font color='red'>{{date("Y-m-d H:i:s",$v->time)}}</font></td>		
			<td><a href="{{url('/curd/destroy/'.$v->curd_id)}}" type="button"class="btn btn-info btn-lg">
				<font color='red'>删除</font></a> 
				 <a href="{{url('/curd/edit/'.$v->curd_id)}}"  type="button"class="btn btn-info btn-lg">
				 	修改</a></td>
		</tr>
		@endforeach
	</tbody>
</table> 
<h3 colspan="6"align="center" style="color:red;background:green; width:100%px">{{$list->appends($curd_name)->links()}}</h3>
</body>
</html>