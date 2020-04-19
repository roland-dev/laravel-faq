<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ajax请求页面</title>
	<script src="https://cdn.bootcss.com/jquery/3.4.0/jquery.min.js"></script>
	<link rel="stylesheet" href="">
</head>
<body>
	<button id="btn">点我</button>
</body>
<script>
	$(function(){
		$("#btn").click(function () {
			$.ajax({
				url: '/home/test/test17',
				type: 'get',
				success: function (data) {
					console.log(data)
				},
				error: function () {

				}								
			})
		})
	})
	
</script>
</html>