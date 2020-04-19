<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>文件上传</title>
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
	<form action="" method="post" enctype="multipart/form-data">
		<p>姓名： <input type="text" name="name" value="" placeholder="请输入"></p>
		<p>年龄： <input type="text" name="age" value="" placeholder="请输入"></p>
		<p>邮箱： <input type="text" name="email" value="" placeholder="请输入"></p>
		<p>头像： <input type="file" name="avatar" value=""></p>
		{{csrf_field()}}
		<input type="submit" value="提交">
	</form>
</body>
</html>