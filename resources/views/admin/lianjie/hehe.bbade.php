<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章</title>
</head>
<body>
	<center>
		<form action="{{url('wen\store')}}"action="post"method="post"enctype="multipart/form-data">
			<table border="1">
				<tr>
					<rd>文章名称</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>文章分类</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>文章重要性</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>是否显示</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>文章作者</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>作者email</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>关键字</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>网页描述</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>上传文件</rd>
					<rd></rd>
				</tr>
				<tr>
					<rd>操作</rd>
					<rd><input type="submit" value="提交"></rd>
				</tr>
			</table>
		</form>
	</center>

</body>
</html>