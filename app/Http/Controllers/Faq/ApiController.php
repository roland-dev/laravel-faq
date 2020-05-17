<?php

namespace App\Http\Controllers\Faq;

use Illuminate\Http\Request;
use Arr;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;


class ApiController extends Controller
{
    private $request;          // 私有方法
	
	// 构造函数
	public function __construct (Request $request)
    {
        $this->request = $request;
    }

    // 问题解决数
    /*

    */
	public function solve(Request $request){
        // 获取所有参数
        $reqData = $this->request->validate([
            'product_line'    => 'nullable|integer',
            'faq_question_id' => 'nullable|integer',
            'like' => 'nullable|integer',
        ]);

        $line = Arr::get($reqData, "product_line");
        $id = Arr::get($reqData, "faq_question_id");
        $like = Arr::get($reqData, "like");

        // 次数
        $times = 0;

        $question = Question::findOrFail($id);

        if ($like == "solve" ) {
            $times = $question->resolvetimes + 1;
            $question->resolvetimes = $times;
            $question->save();
        } else if($like == "unsolve") {
            $times = $question->unresolvetimes + 1;
            $question->unresolvetimes = $times;
            $question->save();
        }

        $res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => [
                "times" => $times 
            ]
        ];
		return $res;
	}

    public function search(Request $request) {
        // 获取所有参数
        $reqData = $this->request->validate([
            'product_line' => 'nullable|integer',
            'value'        => 'nullable|string',
        ]);
        $productLine = Arr::get($reqData, 'product_line');
        $value = Arr::get($reqData, 'value');
        $questions = [];
        // dd($value);
        if (!empty($value)) {
            // 模糊查询使用like来查找，模糊查询后面的字段是"%". ."%"的格式，这里需要强调一下，一定要使用双引号，不然会失效。
            // limit 用来限制
            $questions = Question::where('product_line', $productLine)
                -> where('questions', 'like', "%".$value."%")
                -> limit(10)
                -> get();
        }
        $count = count($questions);

        $res = [
            "code"  => 0,
            "count" => $count,
            "msg"   => "成功",
            "data"  => $questions
        ];

        return $res;
    }
}



















