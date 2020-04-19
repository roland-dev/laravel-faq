<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>表单提交</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="/home/test/test8" method="post">
		<!-- laravel必须带上token值 -->
		姓名： <input type="text" name="name" value="" placeholder="请输入">
		<br>
		年龄： <input type="text" name="age" value="" placeholder="请输入">
		<br>
		年龄： <input type="email" name="email" value="" placeholder="请输入">
		{{csrf_field()}}
		<input type="submit" value="提交">
	</form>
</body>
</html>