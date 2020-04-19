<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>表单提交</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="/home/test/test7" method="post">
		<!-- laravel必须带上token值 -->
		姓名： <input type="text" name="name" value="" placeholder="请输入">
		<br>
		<input type="submit" value="提交">
	</form>
</body>
</html>