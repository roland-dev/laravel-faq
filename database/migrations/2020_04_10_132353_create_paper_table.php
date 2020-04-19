<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 创建数据表
     */
    public function up()
    {
        // schema类 是用于操作数据表的类，调用具体的方法之后就可以实现创建数据表和删除数据表
        Schema::create('paper', function (Blueprint $table) {
            // $table表示整个表的实例
            // 语法$table->列类型方法("字段名"，[长度/值范围]) -> 列修饰方法[修饰的值]
            // 列类型方法的作用:指定列的名称并且设置列的类型长度或其值范围
            // 列修饰方法:添加列的时候还可以使用一些其它列“修改器”，例如，要使列默认为 null，可以使用 nullable方法
            // 自增组件id
            $table->increments('id');
            // 试卷名称 唯一 不为空 varchar(100)
            $table->string('paper_name', 100) -> notNull() -> unique();
            // 总分 整型数字 tinyint 默认100
            $table->tinyInteger('total_score') -> default(100);
            // 开始时间 
            $table->integer('start_time') -> nullable();
            $table->tinyInteger('duration') -> nullable();
            $table->tinyInteger('status') -> default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void 删除数据表，创建数据表的撤销操作
     */
    public function down()
    {
        //
         Schema::dropIfExists('paper');
    }
}
