<?php

namespace App\Http\Controllers\Faq;

use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;


class ApiController extends Controller
{
    // 问题解决数
    /*

    */
	public function solve(Request $request){
        // 获取所有参数
        $params = $request -> all();
        $line = $params["product_line"];
        $id = $params["faq_question_id"];
        $like = $params["like"];

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
        $params = $request -> all();
        // dd($params);
        $productLine = $params['product_line'];
        $value = $params['value'];
        $questions = [];
        if (!empty($value)) {
            // 模糊查询使用like来查找，模糊查询后面的字段是"% %"的格式，这里需要强调一下，一定要使用双引号，不然会失效。
            // limit 用来限制
            $questions = Question::where([['questions', 'like', "%$value%"]]) 
                -> where('product_line', 'like', "%$productLine%")
                -> limit(10)
                -> get();
        }
        $count = count($questions);

        $res = [
            "code"    =>    0,
            "count"   =>    $count,
            "msg"     =>    "成功",
            "data"    =>    $questions
        ];

        return $res;
    }
}



















