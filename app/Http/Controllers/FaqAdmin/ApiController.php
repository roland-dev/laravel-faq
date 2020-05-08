<?php

namespace App\Http\Controllers\FaqAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;

class ApiController extends Controller
{
	// 分类列表
	public function categoryList(Request $request){
		// 获取所有参数
        $params = $request -> all();
        $line = $params["product_line"];
        $currentPage = $params["current_page"];

        $perPage = 10;             // 分页
		$columns = ['*'];          // 纵列
		$pageName = 'page';        // 分页参数
		$total = 0;                // 总数

        // 判断是否返回全部分类  -1为全部
		if($line == -1){
			$categories = Category::paginate($perPage, $columns, $pageName, $currentPage) -> toArray();
		} else {
			$categories = Productline::find($line) -> category() -> paginate($perPage, $columns, $pageName, $currentPage) -> toArray();
		}
		$total = $categories['total'];
		// 判断是否超出页数，超出则返回空数组	
		if($currentPage > $categories['last_page']) {
			$categories = [];
		} else {
			$categories = $categories['data'];			
		}

		// 返回值
	 	$res = [
            "code" 	=> 0,
            "total"	=> $total,
            "msg"  	=> "成功",
            "data" 	=> $categories
        ];
		return $res;
	}

	// 问题列表
	public function questionList(Request $request){
		// 获取所有参数
        $params = $request -> all();
        $line = $params["product_line"];
        $category = $params["faq_category_id"];

        // 获取全部问题
        $questions = Question::offset(10)->get();

	 	$res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => $questions
        ];
		return $res;
	}
}
