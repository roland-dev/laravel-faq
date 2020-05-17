# 一、 leraval 框架 2015.6.9


## 1. 简介

### laravel 是易于理解并且强大的，它提供了强大的工具以开发大型，健壮的应用。 该框架基于symfony

### 特点
1. 单入口，所有的请求必须从单入口开始，主要是便于管理（统一参数过滤）
2. mvc的思想（分层思想，主要是为了协同开发，实现后期的维护方便）
3. ORM 操作数据库（Object Relations Model） AR模式

### laravel框架特点：所有的URL访问都必须事先定好路由规则。

## 2. 开发框架

### php版本>=5.6.4
### php扩展：OpenSSL
### php扩展：PDO
### php扩展：Mbstring

## 3. php安装  环境变量

## 4. composer
1. composer是依赖包安装工具
2. 从应用市场packagist.org到github市场下载到本地的应用程序
3. 使用composer方式部署laravel项目 
第一步： 切换镜像
镜像地址： https://pkg.phpcomposer.com/
第二部： 创建一个laravel项目
composer create-project laravel/Laravel --prefer-dist ./
--prefer--dist

## 目录结构
app          控制器目录
bootstrap    框架启动目录
config       框架配置文件
	app.php         框架主配置文件
	auth.php  		登录配置文件
	databash.php    数据库配置文件
	filesystems.php 上传文件、文件存储需要使用到的配置文件
database      数据库目录
	migrations      迁移目录
	seeds			种子文件【存放一些数据表的数据填充文件】
	factories       工厂文件夹
public       项目单一入口文件和静态资源文件，站点位置指定到public文件下
resources    存放视图文件，还有就是语音包文件的目录
routes       路由目录  web.php 定义路由
storage      存储日志文件和缓存文件，后期用户上传的文件也是在该目录下
tests        测试文件夹
vendor       第三方依赖文件夹

.env         环境配置文件,config目录里面的一般是读取env的文件
artisan      框架脚手架文件，注意用于生成（自动生成），生成控制器，模型文件
composer.json依赖包文件

## 启动
php artisan serve     能够跑php代码，不启动数据库；该方式启动后，如果修改了配置文件.env的话，需要重新启动才能使用
使用wamp环境来使用      配置一个虚拟主机

## 路由
路由是将用户的请求按照事先规划的方案提交给指定的控制器或者功能函数来进行处理，路由必须要手动配置。

## 控制器使用
创建一个test控制器，结构代码会直接创建好
php artisan make:controller TestController

命名空间三元素： 常量 方法 类

控制器路由：使用路由规则调用控制器下的方法，而不再走回调函数。
Route::get('/home/test/test1', 'TestController@test1');

使用控制器创建
php artisan make:controller Admin/IndexController

lavarel控制器里面可以分目录管理

接收用户输入
config/app.php  定义别名

## DB类操作数据库     增删查改+循环+判断
对于MVC框架数据的操作可以在Model里面完成，但是不是用Model，我们可以用Laravel框架提供的DB类操作数据库。
DB::table('tableName') 获取tableName的实例

1、建立数据库
a.sql语句
b.图形界面

create table member(
	id int primary key auto_increment,
	name varchar(32) not null,
	age tinyint unsigned not null,
	email varchar(32) not null
)engine myisam charset utf8;

2、.env 配置数据库

3、定义增删查改路由

## 视图操作
1、分目录管理
（1）文件名建议小写
（2）文件名的后缀是.blade.php
（3）需要注意的是也可以使用.php结尾。 两个文件同时存在，会优先使用.blade.php
（4）如果使用blade.php后缀可以支持方便的blade语法

2、变量的分配与展示
view(模板文件名称，数组)     可以进行数组传值
return view('home/test/test3',['date' => $date, 'day' => $day]);
到模板文件使用{{$date}} 来进行输出

3、compact语法
compact('变量名1', '变量名2')
直接生成对应数组

4、模板中直接使用函数
符号'|',名称为变量修饰符。作用是指视图中解释变量。（管道）
语法：{{函数名(参数1,参数2...)}}
在laravel中。视图调用函数基本与php一致，只不过要求左右包含大括号

5、循环和分支语法标签
foreach($variable as $key => $value) {
	// 循环体
}

laravel中视图的写法
@foreach($variable as $key => $value)

@endforeach

get查询到的结果集中每一条其实都是一个对象，因此在循环具体字段的时候需要注意使用对象调用属性的方式。

6、模板继承/包含
extends
include
编写一个父级页面
编写一个子级页面
语法：
@yield('title')

7、外部静态文件的引入方式
/css/app.css
laravel 封装了一个asset方法
{{asset(css/app.css)}}

laravel.mix()
静态图片文件导入

## CSRF攻击
1、跨站请求伪造攻击
Lvravel自动为每个用户session生成一个CSRF Token，该Token可用于验证登录用户和发起请求是否是同一个人，
如果不是则请求失败

2、排除csrf需要添加csrf_token
<input type="hidden" name="_token" value="{{csrf_token()}}">
{{csrf_field()}}

使用ajax提交的时候，只能使用csrf_token来完成异步提交。

3、从csrf中排除不需要token验证的路由

## 模型操作
ActiveRecord实现，AR模式，laravel自带Eloquent ORM。
每张数据表都对应一个与该表进行交互的"Model模型", 模型允许你在表中进行数据的增删查改
三个核心：
	每个数据表      与数据表进行交互的Model模型映射（实例化模型）
	记录中的字段    与模型类的属性映射（给属性赋值）
	表中的每个记录  与一个完整的请求实例映射

模型名   表面（首字母大写）.php

创建模型
php artisan make:model Home/Member

注意事项：
1、（必做）定义一个$table属性，值是不要前缀的表名，如果不指定则使用类名的复数形式作为表名。
2、定义$primaryKey属性，值是主键名称，如果需要使用AR模式的find方法，则可能需要指定主键（Model::find(n)）
3、定义$timestamps属性，值是false，不设置会默认操作created_at和updated_at
4、定义$fillable属性，表示使用模型插入数据时，允许插入到数据库的字段

模型在控制器中的使用方式有两种：
1、直接使用DB门面一样的操作方式：以调用静态方法为主的形式，该形式下模型不需要实例化，例如：Member::get()
2、实例化模型然后再去使用模型类
	例如：$model = new Member(); $model->get();



## 自动验证
一般一个框架都会提供一个自动验证。

1. 创建一个表单页面
2. 创建需要的路由、方法

use Illuminate\Http\Request

protected function validateLogin(Request $request)
{	
	// 可以使用系统默认的验证提示语，也可以自定义系统提示语
	// 自定义的系统提示语,是validata()的第二个参数
    $request->validate([ 
        'username' => 'required|string',
        'password' => 'required|string',
        'captcha' => ['required', 'captcha'],
    ], [
        'captcha.required' => '验证码不能为空',
        'captcha.captcha' => '请输入正确的验证码',
    ]);
}

### 手册中的HTTP----验证

如果得知一个请求类型？
语法: Input::method();      // 返回GET或者POST

### 基础验证规则
required: 非空
max:
min:
email:
confirmed: 验证两个字段是否相同，如果验证的字段是password,则必须输入一个与之匹配的password confirmation字段
integer: 验证字段为整型
ip: 验证字段必须是IP地址
numeric: 验证字段必须是数值
max:value 验证字段必须小于等于最大值，和字符串 数值 文件字段的size规则一起用
unique: 唯一性
size: 指定字符串长度或者数字大小

多个验证规则可以用“|”来区分开

### 输出错误信息

### 修改成中文语言包
packagist.org 网站  搜索laravel-lang
在项目的根目录运行命令 
```
		composer require caouecs/laravel-lang:~3.0
```

1. 复制vendor/caouecs/laravel-lang/zh-CN目录复制到resources/lang目录下面
2. 修改config/app.php中locale的语言包简写zh-CN
3. 并不是所有的字段都有翻译，如果想自己定义就需要改resources/lang/zh-CN里面修改

## 文件上传
创建视图并且添加csrf_token
不考虑异步方式，表单如何上传
1. form表单标签 method必须为post 必须具备enctype属性
2. 至少由一个input类型为file类型
3. 具备提交按钮

在控制器上添加上传业务处理逻辑代码，HTTP请求类型里面上传文件实例
关于上传错误状态码，0到7，但是没有5，0表示成功

关于项目中使用路径的说明：如果路径是给php代码使用的，则路径建议使用"./"形式；如果路径是给浏览器使用的则建议使用::

上传完成之后，将数据写入数据表。

## 数据分页
调用模型中的分页方法，返回对应的数据和分页字符串
分页实现步骤
1. 查询符合分页的条件的总记录数
2. 通过每页条数，获取总页数
3. 拼凑分页的链接
4. 核心操作，使用limit语法来限制分页的记录数
5. 展示分页的页码和分页数据
6. 考虑一下分页的样式显示问题

### 创建路由，并且展示分页页面
分页方法是由模型提供的分页方法paginate() 和 simplePaginate()

## 验证码
生成验证码存入session、输出图片

验证码安装依赖（require php: ^7.2  ext-gd: * )
composer require mews/captcha

In Windows, you'll need to include the GD2 DLL php_gd2.dll in php.ini. 
And you also need include php_fileinfo.dll and php_mbstring.dll to fit the requirements of mews/captcha's dependencies.

修改配置文件 config/app.php
如果需要定义自己的配置需要生成配置文件
php artisan vendor:publish

1. 验证码需要在页面上显示出来
2. 验证码的验证操作
3. 在lang语言包里面可以修改验证用语

## 数据表的迁移和填充
1. 数据的迁移操作
存放在database/migrations目录下的文件为迁移文件
php artisan make:migration 迁移文件名

新生成文件包括up() 和 down()两个方法。   迁移文件仿之前的即可，大多数地方基本不需要变化。
执行迁移文件
如果是第一次的话，需要先执行php artisan migrate:install
作用：用于创建记录迁移文件的过程，执行之后数据表会多出一个migration表
migtation 表示已经执行的迁移文件名
batch 批次号，执行的序号

只保留自己创建的，把其他原来系统的迁移文件删除掉
执行 php artisan migrate
迁移的记录表会多出一条记录，同时下面会产生一个新表
执行 php artisan migrate:rollback
回滚上次的迁移表，回滚操作只删除对应的记录和数据表，不删除迁移文件

2. 数据表填充器
填充器的创建和编写
存放在database/seeds目录下的文件为填充文件
php artisan make:seeder 填充器名称    约定写法（大写表名+TableSeeder）

执行填充器文件
种子文件不像迁移文件，没有记录，执行种子文件时候需要指定需要执行的种子文件
php artisan db:seed --class=PaperTableSeeder

使用工厂类生成批量的数据
我们可以使用模型工厂来方便的生成大量的数据库记录。首先，查看模型工厂文档来学习如何定义工厂，定义工厂后，可以使用辅助函数 factory 来插入记录到数据库。
factory('App\User', 50)->create()->each(function($u) {
        $u->posts()->save(factory('App\Post')->make());
    });

调用额外的填充器
在 DatabaseSeeder 类中，你可以使用call 方法执行额外的填充类，使用 call 方法允许你将数据库填充分解成多个文件，这样单个填充器类就不会变得无比巨大，只需简单将你想要运行的填充器类名传递过去即可


## 项目初始化
### composer create laravel目录结构

### create 数据库
pma、mysqlCLI、
修改.env文件，连接数据库

### 设置网站本地化为中文
下载复制语言包， 修改config/app.php   配置项locale => "zh.CN"

### 修改项目使用的时区 修改config/app.php   配置项timezone => "Aisa/shanghai" 或 "PRC"

### 清理项目
Auth控制器是项目原来提供的，可以删除
可以删除迁移目录下的原始文件
可以删除填充目录下的原始文件
删除laravel删除页

### 关闭Mysql的严格模式，方便初学者
database.php     配置项 strict   

## 安装debugbar工具条（可选）
https://packagist.org/packages/barryvdh/laravel-debugbar
安装完成后，修改config/app.php 中的相应位置

安装完成之后 进行响应时间的内容填写，ok，这就是我们目前想要显示的内容。
如果可以的话，我希望下个星期的星期一，进行一个时间合适的内容测试，不需要有很的多的人，就一对一进行讲解就可以了。

## 响应处理
常规的响应和Ajax的响应

展示视图 return view('welcome');
ajax 请求的响应


常见的ajax响应数据类型: json和xml、text/html
案例：在页面中输出一个按钮，按钮要可以被点击，点击之后发送一个ajax请求，请求后台的数据，后台返回前端一个ajax一个json的数据，不要使用json_encode类型。

## 跳转响应
同步添加一些页面跳转的操作，来完成跳转响应。
Return redirect(路由);
Return redirect()->to(路由);

## 会话控制
增删查改
session默认存到文件中
session文件的目录 storage/framework/sessions

use Session;    // 别名已经存在项目中，可以直接引入
session在视图中也可以直接使用{{Session::get('code')}}

常用方法
Session::put(key, value)   // session存值
Session::get(key)   // session取值
Session::get(key, 'default')   // session取值, 没有则填入默认值
Session::get(key, function(){
	return 'dafault';
}) // 回调函数
Session::all()
Session::has('users')
Session::forget('key')  // 删除一个变量
Session::flush();       // 删除所有变量

## 缓存操作
缓存配置在config/cache.php  在该文件中可以指定在应用中使用哪个缓存驱动，如redis
Cache::put('key', 'value', $minutes);

// add 方法只会在缓存项不存在的情况下添加数据到缓存，如果数据被成功添加到缓存返回 true，否则，返回false：
Cache::add('key', 'value', $minutes);   
Cache::forever('key', 'value');
Cache::forget('key');
Cache::flush(); 
Cache::pull('key');    // 一次性的存储，获取到然后删除
Cache::increment($key, $value = 1) {}        // 缓存递增
Cache::decrement($key, $value = 1) {}        // 缓存递减

除了使用 Cache 门面或缓存契约，还可以使用全局的 cache 函数来通过缓存获取和存储数据。当带有一个字符串参数的 cache 函数被调用时，会返回给定键对应的缓存值            
$value = cache('key');


## 联表查询
显示文章和作者名
查询id为1的文章

数据来源两个表  文章表（id article_name author_id）  
			   作者表（id author_name)

表一 文章表    t1   主表（跟在from关键词后面的表）
表一 文章表    t2   从表（跟在join关键词后面的表）

关联条件t1.author_id = t2.id
连表方式： 左外连接
原始的sql语句:
select t1.id,t1.article_name,t2.author_name from article as t1 left join author as t2 on t1.author_id=t2.id;

将上述的sql语句改成链式操作：
语法：DB门面/模型 -> join 联表方式名称（关联的表名，表一的字段，运算符，表2的字段）
$users = DB::table('users')
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->get();

## 关联模型 （重点+难点）
关联模型就是绑定模型的关系（关联表），后续需要使用联表的时候就可以直接使用关联模型。
1. 一对一关系
例如: 一篇文章只有一个作者

a. 创建模型   php artisan make:model Home/Article
b. 创建模型   php artisan make:model Home/Author
c. 关联模型的关联方法  确认哪个是主表，哪个是副表，当前案例是使用文章去关联作者，需要把关联的代码写到主模型里面。

语法： public function 被关联的模型名小写(){
	return $this -> hasOne('需要关联模型的命名空间','外键','本地键');
}
使用动态属性进行执行
通过关联模型一对一关系查询出每个文章对应的作者名称。
使用模型方法，可以替代join查表问题。

2. 一对多关系
例如：一篇文章有多个评论

由于文章和评论是一对多的关系，还需要去创建一个数据表，评论表(id, comment, article_id)。

案例：查询出每个文章下的所有评论。
使用hasMany()方法。

3. 多对多关系
例如：一个文章有多个关键词  一个关键词有多个文章

当点开关键词的超链接之后，会发现一个关键词下面能搜出很多的文章。
因此，文章和关键词直接是多对多的关系。

多对多的关系经过拆分之后其实就是两个一对多的关系。由于是双向的一对多的关系，单靠两张表是无法建立关系的。
新建一个【关键词】数据表，一个【文章与关键词】关系表。

关键词表（id, keyword）
文章与关键词的关系表（id, article_id, key_id）

创建需要的模型
注意：根据手册中记录的语法要求，不需要给关系表单独创建模型。
该处只需要单独的给keyword创建模型即可

php artisan route:list    // 命令行查询路由列表

A RESTful接口路由方式

Route::resource('users', 'UsersController');

路由对应方法名:
Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy


























































