<?php

use Illuminate\Database\Seeder;

class PaperTableSeeder extends Seeder
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
        $data = [
        	[
        		'paper_name'      => '五年高考，三年模拟',
        		'start_time'      => strtotime('+7 days'),
        		'duration'      => '120',
        	],
        	[
        		'paper_name'      => '五年，三年模拟',
        		'start_time'      => strtotime('+7 days'),
        		'duration'      => '110',
        	],
        	[
        		'paper_name'      => '五年高考，模拟',
        		'start_time'      => strtotime('+5 days'),
        		'duration'      => '170',
        	],
        	[
        		'paper_name'      => '五年高三年模拟',
        		'start_time'      => strtotime('+10 days'),
        		'duration'      => '100',
        	]
        ];
        // 写入数据
        DB::table('paper') -> insert($data);
    }
}
