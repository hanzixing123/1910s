<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>add页面</title>
</head>
<body>
	<form action="{{url('/index/add')}}"method="post">
	@csrf
	<table border="1">
			
		<tr>
			<td>名字</td>
			<td><input type="text" name="name" value="{{$kk}}"></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="text" name="pwd" value="{{$k}}"></td>
		</tr>
		<tr>
		
		<td><input type="submit" value="登录"></td>
		</tr>
	</table>
</form>
</body>
</html>