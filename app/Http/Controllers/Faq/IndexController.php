<?php

namespace App\Http\Controllers\Faq;

use Illuminate\Http\Request;
use Arr;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;


class IndexController extends Controller
{	
	private $request;          // 私有方法
	
	// 构造函数
	public function __construct (Request $request)
    {
        $this->request = $request;
    }
	
	// 常见问题主页
	public function index(){
		$reqData = $this->request->validate([
            'faq_category_id' =>  'nullable|integer',
            'product_line'    =>  'nullable|integer',
        ]);
		$id = Arr::get($reqData, 'faq_category_id', 1);
		$line = Arr::get($reqData, 'product_line', 1);

		// 联表查询当前生产线下对应的分类（多对多）
		$categories = Productline::find($line) -> category() -> get();
		$questions = Question::where('faq_category_id', $id) -> get();
		return view('faq.index', [
			'categories' => $categories, 
			'questions'  => $questions,
			'id'         => $id,
			'line'       => $line
		]);
	}

	// 问题详情页
	public function detail(){
		$reqData = $this->request->validate([
            'faq_question_id' => 'nullable|integer',
            'product_line'    => 'nullable|integer',
		]);
		$id = Arr::get($reqData, 'faq_question_id');
		$line = Arr::get($reqData, 'product_line');
		$question = Question::find($id) -> toArray();
		// dd($question);
		return view('faq.detail', [
		    'questions'      => Arr::get($question, 'questions'),
			'answers'        => Arr::get($question, 'answers'),
			'resolvetimes'   => Arr::get($question, 'resolvetimes'),
			'unresolvetimes' => Arr::get($question, 'unresolvetimes'),
			'line'           => $line,
			'id'             => $id
		]);
	}

	// 联系我们
	public function attention() {
		return view('faq.attention_us');
	}
}
