<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment') -> insert([
        	[
        		'comment'  => '哈哈哈',
        		'article_id'      => rand(1,5)
        	],
        	[
        		'article_name'  => '解放军奥利弗就',
        		'article_id'      => rand(1,5) 
        	],
        	[
        		'article_name'  => '离开过啦',
        		'article_id'      => rand(1,5) 
        	],
        	[
        		'article_name'  => '有个哈萨克',
        		'article_id'      => rand(1,5) 
        	],
        	[
        		'article_name'  => '小两口攻击力看来',
        		'article_id'      => rand(1,5) 
        	],
        ]);
    }
}
