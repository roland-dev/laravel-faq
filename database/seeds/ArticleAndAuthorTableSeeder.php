<?php

use Illuminate\Database\Seeder;

class ArticleAndAuthorTableSeeder extends Seeder
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
        DB::table('article') -> insert([
        	[
        		'article_name'  => '使用一個名稱',
        		'author_id'      => rand(1,3)
        	],
        	[
        		'article_name'  => '使用得到一個名稱',
        		'author_id'      => rand(1,3) 
        	],
        	[
        		'article_name'  => '使用方法一個名稱',
        		'author_id'      => rand(1,3) 
        	],
        	[
        		'article_name'  => '使用灌灌一個名稱',
        		'author_id'      => rand(1,3) 
        	],
        	[
        		'article_name'  => '使用一個名水水稱',
        		'author_id'      => rand(1,3) 
        	],
        ]);
        // 写入数据
        DB::table('author') -> insert([
        	[
        		'author_name'   => '人民网',
        	],
        	[
        		'author_name'   => '百合网',
        	],
        	[
        		'author_name'   => '新华网',
        	],
        	[
        		'author_name'   => '十虎网',
        	],
        ]);
    }
}
