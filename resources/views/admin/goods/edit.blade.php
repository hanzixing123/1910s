<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	
     <center> <h2><font color='red'>商品添加页面</font><h2>
 <a href="{{url('/goods')}}" type="button" class="btn btn-info btn-lg">查看列表</a> 
     </center>
<!-- @if ($errors->any()) 
<div class="alert alert-danger"> 
<ul>@foreach ($errors->all() as $error)
 <li>{{ $error }}</li> 
 @endforeach
</ul> 
</div> 
@endif -->


<form class="form-horizontal" action="{{url('goods/update/'.$goods->goods_id)}}" method="post"  role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" name="goods_name" value="{{$goods->goods_name}}" class="form-control" id="firstname" 
				   placeholder="请输入商品名称">
				   <b><font color='red'><h4>{{$errors->first('goods_name')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" name="goods_name"  class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-10">
				<select name="brand_id">
					<option value="">请选择品牌</option>
				@foreach($brand_id as $v)
					<option value="{{$v->brand_id}}"@if($v->brand_id==$goods->brand_id) selected @endif >{{$v->brand_name}}</tption>
				@endforeach
				</select>
				<b><font color='red'><h4>{{$errors->first('brand_id')}}</h4></font></b>
		</div>
	</div>
		<div class="form-group">
		<label for="lastname" name="goods_name" value=""  class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-10">
				<select name="cate_id">
					<option value=''>所属分类</option>
				@foreach($cate_id as $v)
					<option value="{{$v->cate_id}}"@if($v->cate_id==$goods->cate_id)selected @endif>{{str_repeat('|——>',$v->level)}}{{$v->cate_name}}</tption>
				@endforeach
				</select>
				<b><font color='red'><h4>{{$errors->first('cate_id')}}</h4></font></b>
		</div>
	</div>	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text"  name="goods_price" value="{{$goods->goods_price}}"class="form-control" id="firstname" 
				   placeholder="请输入商品价格">
				   <b><font color='red'><h4>{{$errors->first('goods_price')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text"   name="goods_num" value="{{$goods->goods_num}}" class="form-control" id="firstname" 
				   placeholder="请输入商品库存">
				    <b><font color='red'><h4>{{$errors->first('goods_num')}}</h4></font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_new" value="1" @if($goods->is_new==1)checked @endif>是
			<input type="radio"  name="is_new" value="0" @if($goods->is_new==0)checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_dest" value="1" @if($goods->is_dest==1)checked @endif>是
			<input type="radio"  name="is_dest" value="0" @if($goods->is_dest==0)checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_up" value="1" @if($goods->is_up==1)checked @endif>是
			<input type="radio"  name="is_up" value="0" @if($goods->is_up==0)checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">图片</label>
		<div class="col-sm-10">
			<img width="200"  src="{{env('TUPIAN_URL')}}/{{$goods->img}}">
			<input type="file"name="img">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">图集</label>
		<div class="col-sm-10">
			<input type="file" multiple   name="imgs[]">
		</div>
	</div>
		<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否首页幻灯片推荐</label>
		<div class="col-sm-10">
			<input type="radio" name="is_silde"  value="1"@if($goods->is_silde==1)checked @endif>是
			<input type="radio" name="is_silde"  value="0"@if($goods->is_silde==0)checked @endif>否
		</div>
	</div>
		<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea name="goods_desc"  cols="40" rows="10">{{$goods->goods_desc}}</textarea>
			<b><font color='red'><h4>{{$errors->first('goods_desc')}}</h4></font></b>
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>