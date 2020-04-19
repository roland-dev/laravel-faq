<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>表单提交</title>
	<link rel="stylesheet" href="">
</head>
<body>
	@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
	@endif
	<form action="" method="post">
		<!-- laravel必须带上token值 -->
		姓名： <input type="text" name="name" value="" placeholder="请输入">
		<br>
		<br>
		年龄： <input type="text" name="age" value="" placeholder="请输入">
		<br>
		<br>
		邮箱： <input type="email" name="email" value="" placeholder="请输入">
		<br>
		验证码 <input type="text" name="captcha"> 
		<p><img src="{{captcha_src()}}" alt=""></p>
		{{csrf_field()}}
		<br>
		<br>
		<input type="submit" value="提交">
	</form>
</body>
</html>