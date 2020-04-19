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
}
