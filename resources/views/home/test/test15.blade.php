<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>数据分页</title>
	<link rel="stylesheet" href="">
	<style>
		table,th,td{
			border: 1px solid;
		}
		li{
			list-style: none;
			display: inline-block;
			padding: 4px;
			margin: 4px;
			border: 1px solid;
		}
	</style>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>id</th>
				<th>名字</th>
				<th>年龄</th>
				<th>邮箱</th>
				<th>头像</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr>
				<td>{{$val -> id}}</td>
				<td>{{$val -> name}}</td>
				<td>{{$val -> age}}</td>
				<td>{{$val -> email}}</td>
				<!-- ltrim(字符串，删除左边特定字符) 
					删除图片链接的.-->
				<td><img src="{{ltrim($val -> avatar, '.')}}" width="60px" alt=""></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $data -> links() }}
	<!-- ->conut()    //当前页数据条数
		 ->currentPage()    //当前页码
		 ->firstItem()    //当前页第一条数据的序号
		 ->total()    //记录总条数
		 ->conut()    //当前页数据条数
	 -->

</body>
</html>