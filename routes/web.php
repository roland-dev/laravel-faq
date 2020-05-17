<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 根路由 Route （"请求的URL" 匿名函数或控制响应的方法）
Route::get('/', function () {
    return view('welcome');
});

// 访问根目录下的/home地址
Route::get('/home', function () {
    echo "hello world";
});

// 一个路由响应多个请求
// match
Route::match(['get', 'post'], "/match", function () {
    return "match类型的请求";
});

// any
Route::any("/any", function () {
    echo "any类型的请求";
});

// 路由参数  必选参数{参数名}和可选参数{参数名?}
Route::get('/test/{id}', function ($id) {
    echo "hello world" . $id;
});

Route::get('/test2/{id?}', function ($id=0) {
    echo "hello world" . $id;
});

// 路由可以通过?来传递get参数
Route::any("/test5", function () {
    echo "当前test5的id是" . $_GET['id'];
});

// 路由的别名
Route::any('/user/profile', function () {  
   echo "hello world";
})->name('profile');

// 查看路由 php artisan route:list

// 路由群组
Route::group(['prefix' => 'admin'], function(){
	Route::get('test2', function () {
	    echo "hello world";
	    // 匹配/admin/test2
	});
});

// 控制器路由写法
Route::get('/home/test/test1', 'TestController@test1');
Route::get('/home/test/test2', 'TestController@test2');

// DB下的增删查改
Route::get('/home/test/add', 'TestController@add');
Route::get('/home/test/del', 'TestController@del');
Route::get('/home/test/update', 'TestController@update');
Route::get('/home/test/select', 'TestController@select');

Route::group(['prefix' => 'home/test'], function(){
	Route::get('add', 'TestController@add');
	Route::get('del', 'TestController@del');
	Route::get('update', 'TestController@update');
	Route::get('select', 'TestController@select');
	Route::get('test3', 'TestController@test3');

});

// 分目录管理
Route::get('/home/index/index', 'Home\IndexController@index');
Route::get('/admin/index/index', 'Admin\IndexController@index');

Route::get('/home/test/test4', 'TestController@test4');

// 两个路由 创建表单(get)  处理请求(post)  csrf验证
Route::get('/home/test/test6', 'TestController@test6');
Route::post('/home/test/test7', 'TestController@test7');

Route::post('/home/test/test8', 'TestController@test8');
Route::get('/home/test/test9', 'TestController@test9');
Route::get('/home/test/test10', 'TestController@test10');
Route::get('/home/test/test11', 'TestController@test11');
Route::get('/home/test/test12', 'TestController@test12');

// 自动验证, any自己提交给自己
Route::post('/home/test/test13', 'TestController@test13');

// 文件上传
Route::any('/home/test/test14', 'TestController@test14');

// 分页操作
Route::get('/home/test/test15', 'TestController@test15');

// 响应方式
Route::get('/home/test/test16', 'TestController@test16');
Route::get('/home/test/test17', 'TestController@test17');

// 会话控制
Route::get('/home/test/test18', 'TestController@test18');

// 缓存操作
Route::get('/home/test/test19', 'TestController@test19');
// 联表查询
Route::get('/home/test/test20', 'TestController@test20');
// 一对一
Route::get('/home/test/test21', 'TestController@test21');
// 一对多
Route::get('/home/test/test22', 'TestController@test22');
// 多对多
Route::get('/home/test/test23', 'TestController@test23');

// ------------------------ start faq --------------------
// 常见问题前台和后台
Route::get('/faq/admin', 'FaqAdmin\IndexController@index');
Route::get('/faq/admin/rank_list', 'FaqAdmin\IndexController@rank');
Route::get('/faq/home', 'Faq\IndexController@index');

// 文章详情页
Route::get('/faq/home/detail', 'Faq\IndexController@detail');
// 联系我们
Route::get('/faq/index/attention_us', 'Faq\IndexController@attention');

// ------------------------- end faq -------------------













