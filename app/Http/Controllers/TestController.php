<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 引入DB模块(已定义可以直接使用)
use DB;
// 引入模型
use App\Home\Member; 
use App\Home\Article;
use App\Home\Author;

// 引入session
use Session;
use Cache;

class TestController extends Controller
{
    // phpinfo函数
    public function test1(){
    	phpinfo();
    }

    //test2 测试input获取数据
    public function test2(){
    	// 获取一个id如果没有则使用第二个参数当默认值
    	// echo Input::get('id', '10086');
    	echo '<br/>';
    	// 获取全部的值(返回数组形式)
    	$all = Input::all();
    	// dd() 表示dump + die
    	// dd($all);
    	
    	// 获取指定字符串
    	// dd(Input::get('name'));

    	// 获取指定值
    	// dd(Input::only('name', 'id'));
    	// 取反
    	// dd(Input::except('name'));
    	// has 判断存在参数，返回布尔值
    	// dd(Input::has('name'));
    }

    public function add(){
    	// insert()   可以是一条或多条，返回值布尔类型
    	// insertGetId()  只能添加一条数据，返回自增的id
    	$db = DB::table('member');
    	// $result = $db -> insert([
    	// 		'name' => '马夏梅',
    	// 		'age' => 18,
    	// 		'email' => 'maxiamei@163.com'
    	// ]); 

    	$result = $db -> insertGetId([
    			'name' => '马秋梅',
    			'age' => 18,
    			'email' => 'maqiumei@163.com'
    	]);
    	dd($result);
    }

    public function del(){
    	$db = DB::table('member');
    	$result = $db -> where('id', '4') -> delete();
    	dd($result);  // 受影响行数
    }

    public function update(){
    	// update() increment() decrement()
    	// update() 可以修改记录中的全部字段
    	// increment() decrement() 修改数字字段的数值   典型应用 登录次数、积分增加
    	$db = DB::table('member');
    	// 修改id为1的用户名
    	$result = $db -> where('id', '=', '1') -> update([
    		'name' => '张三丰',
    	]);
    	dd($result);  // 返回值为受到影响的行数
    }

    public function select(){
    	// 取出基本数据
    	$db = DB::table('member');
    	// 查询全部数据
    	$data = $db -> get();

    	// 尝试循环数据 get()查询的结果每一行是对象
    	foreach ($data as $key => $value) {
    		echo "id是： {$value -> id}, 名字是：{$value -> name}, <br/>";
    	}

    	// 查询id>3的数据 where() -> where()   并
    	// 			     where() -> orWhere() 或
    	// first()  取出单行记录
    	$data1 = $db -> where('id', '>', '2') -> orWhere('age', '<', '20') -> get() -> first();

    	// 取出具体的值
    	$data2 = $db -> where('id', '2') -> value('age');

    	// 查寻指定的一些字段的值 
    	$data3 = $db -> select('name', 'email') -> get();

    	// 排序操作 orderBy    desc asc
    	$data4 = $db -> orderBy('age') -> get();
    	dd($data4);

    	// 分页操作  limit()->offset()
    	// limit() 限制输出的条数
    	// offset() 从什么地方开始
    	$data5 = $db -> limit(1)->offset(2) -> get();
    }

    // test3
    public function test3(){
    	// 展示视图
    	// 获取时间
    	$date = date('Y-m-d H:i:s', time());
    	// 获取星期
    	$day = '日';
    	// 时间戳
    	$time = time();
    	return view('home/test/test3',['date' => $date, 'day' => $day, 'time' => $time]);
    }

    public function test4(){
    	// 循环标签
    	$data = DB::table('member') -> get();
    	// 展示视图，传递数据
    	return view('home.test.test4', compact('data'));
    }

    public function test6(){
        // 展示视图，传递数据
        return view('home.test.test6');
    }

    public function test7(){
        // 展示视图，传递数据
        return '请求提交成功';
    }

    public function test8(Request $request){
        // 展示视图，传递数据
        // $member = new Member(); 
        // $member -> name = '顶顶顶';
        // $member -> age = '16';
        // $member -> email = 'dingdingding@163.com';

        // $result = $member -> save();
        $model = new Member();
        
        $result = $model -> create($request -> all());
    }

    public function test9(){
        // 展示视图，传递数据
        // 静态方法调用，获取主键为1的数据
        $result = Member::find(4) -> toArray();
        // 查询符合条件的第一条数据
        $result = Member::where('id', '>', '1') -> first();
        // all()方法不支持链式操作
        dd($result);
    }

    public function test12(){
        // 展示视图，传递数据
        return view('home.test.test12');
    }

    // 自动验证
    public function test13(Request $request){
        $validatedData = $request->validate([
        //     // 具体的规则
        //     // 字段 => 验证规则1|验证规则2
        //     // min和max会自动根据字段是字符串或者数字来改变判定规则
            'name' => 'required|min:2|max:20',
            'age' => 'required|Integer|min:1|max:100',
            'email' => 'required|email',
            'captcha' => 'required|captcha'
        ]);     
    }

    // 文件上传
    public function test14(Request $request){
        if (Input::method() == "POST") {
            // 判断文件是否正常存在
            // 获取相关信息
            // 保存文件到合适的位置
            if($request -> hasFile('avatar') && $request -> file('avatar')->isValid()){
                // dd($request-> file('avatar') -> getClientOriginalName());
                // 移动文件 move(目录，文件名)
                // time() 当前时间戳    rand(min,max) 取min和max之间的循环数
                // getClientOriginalExtension() 获取文件后缀名
                $path = md5(time() . rand(100000, 999999)) . '.' . $request-> file('avatar') -> getClientOriginalExtension();
                $request-> file('avatar') -> move('./uploads', $path);
                
                // 获取全部的数据
                $data = $request -> all();
                // 将路径添加到数组中
                $data['avatar'] = './uploads/' . $path;
                $result = Member::create($data);
                if($result){
                    // 重定向路由
                    return redirect("/");
                }
                // 如果上传出现错误，使用 getErrorMessage()
            }


            // $this -> validate($request, [
            //     // 具体的规则
            //     // 字段 => 验证规则1|验证规则2
            //     // min和max会自动根据字段是字符串或者数字来改变判定规则
            //     'name' => 'required|min:2|max:20',
            //     'age' => 'required|Integer|min:1|max:100',
            //     'email' => 'required|email',
            // ]);
        } else {
            // 展示视图，传递数据
            return view('home.test.test14');
        }
        
    }

    // 分页
    public function test15(Request $request){
       // 查询数据 基本分页语法 1表示每页显示条数 paginate()使用方法类似get()
       $data = Member::paginate(2);

       // 模板页面显示分页结果

        // 展示视图，传递数据
        return view('home.test.test15', compact('data'));
        
    }

    // 展示视图页面来响应ajax
    public function test16(Request $request){
        // 展示视图，传递数据
        return view('home.test.test16');
        
    }

    // ajax响应方法
    public function test17(Request $request){
        // 查询数据
        $data = Member::all();
        // json格式响应
        // return json_encode($data);
        // lavarel框架里面使用的语法需要响应json数据，则写成语法
        // lavarel中不能直接返回布尔值
        return response() -> json($data);

    }

    // 会话控制
    public function test18(Request $request){
        Session::put('name', '样三');
        
        // session名不存在返回回调函数
        dd(Session::get('namoe', function(){
            return 123;
        }));
        dd(Session::all());
        dd(Session::get('name'));
        return 'hello';

    }

    // 缓存操作
    public function test19(Request $request){
        // 设置一个缓存，如果存在就覆盖
        Cache::put('class', 'qz04', 10);
        dd(cache('class'));
        // 设置一个缓存，如果不存在就添加，存在就不添加
        Cache::add('class', 'qz04', 10);
        // 删除一个缓存
        Cache::forget('class');
        // 获取一个值，如果不存在就显示默认值
        return Cache::get('class', 'default');

    }

    // 联表查询
    public function test20(Request $request){
        // 查询
        $data = DB::table('article as t1') 
            -> select('t1.id','t1.article_name','t2.author_name') 
            -> leftJoin('author as t2', 't1.author_id', '=', 't2.id')
            -> get();
        dd($data);       
    }

    // 联表查询一对一
    public function test21(Request $request){
        // 查询
        $data = Article::get();
        foreach ($data as $key => $value) {
            echo $value -> id . '&emsp;' . $value -> article_name . '&emsp;' . $value -> author -> author_name . '<br>'; 
        }   
    }

    // 联表查询一对多
    public function test22(Request $request){
        // 查询
        $data = Article::get();
        foreach ($data as $key => $value) {
            echo '当前的文章名称为：' . $value -> article_name . '.其下的评论为：<br/>';
            foreach ($value -> comment as $k => $val) {
                echo '&emsp;' . $val -> comment . '<br/>';
            }
        }
        // dd($data);       
    }

    // 联表查询多对多
    public function test23(Request $request){
        // 查询
        $data = Article::get();
        foreach ($data as $key => $value) {
            echo '当前的文章名称为：' . $value -> article_name . '.其下的关键词为：<br/>';
            // 输出关键词
            foreach ($value -> keyword as $k => $val) {
                echo '&emsp;' . $val -> keyword . '<br/>';
            }
        }        
    }
}
