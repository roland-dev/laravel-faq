<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // schema类 是用于操作数据表的类，调用具体的方法之后就可以实现创建数据表和删除数据表
        Schema::create('keyword', function (Blueprint $table) {
            // $table表示整个表的实例
            // 语法$table->列类型方法("字段名"，[长度/值范围]) -> 列修饰方法[修饰的值]
            // 列类型方法的作用:指定列的名称并且设置列的类型长度或其值范围
            // 列修饰方法:添加列的时候还可以使用一些其它列“修改器”，例如，要使列默认为 null，可以使用 nullable方法
            // 自增组件id
            $table -> increments('id');
            $table -> string('keyword', 10) -> notNull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('keyword');
    }
}
