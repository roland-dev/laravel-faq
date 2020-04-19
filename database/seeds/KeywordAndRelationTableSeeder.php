<?php

use Illuminate\Database\Seeder;

class KeywordAndRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	// 编写填充器的代码，实现往数据表中写入数据
        // DB类在使用时候，不需要用户自己引入
        // 写入数据
        DB::table('keyword') -> insert([
        	[
        		'keyword'  => '芳华',
        	],
        	[
        		'keyword'  => '冯小刚',
        	],
        	[
        		'keyword'  => '老炮儿',
        	],
        	[
        		'keyword'  => '导演',
        	]
        ]);
        DB::table('relation') -> insert([
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        	[
        		'article_id'  => rand(1,5),
        		'key_id'      => rand(1,4)
        	],
        ]);
    }
}
