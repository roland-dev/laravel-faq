<?php

namespace App\Http\Controllers\Faq;

use Illuminate\Http\Request;
use Input;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;


class IndexController extends Controller
{
	// 常见问题主页
	public function index(){
		$id = Input::get('faq_category_id', 1);
		$line = Input::get('product_line', 1);
		// 联表查询当前生产线下对应的分类（多对多）
		$categories = Productline::find($line) -> category() -> get();
		$questions = Question::where('faq_category_id', $id) -> get();
		return view('faq.index', [
			'categories' => $categories, 
			'questions' => $questions,
			'id' => $id,
			'line' => $line
		]);
	}

	// 问题详情页
	public function detail(){
		$id = Input::get('faq_question_id');
		$line = Input::get('product_line');
		$question = Question::find($id) -> toArray();
		// dd($question);
		return view('faq.detail', [
			'questions' => array_get($question[0], 'questions'),
			'answers' => array_get($question[0], 'answers'),
			'resolvetimes' => array_get($question[0], 'resolvetimes'),
			'unresolvetimes' => array_get($question[0], 'unresolvetimes'),
			'line' => $line,
			'id' => $id
		]);
	}
}
