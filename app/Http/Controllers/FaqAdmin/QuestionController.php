<?php

namespace App\Http\Controllers\FaqAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Arr;
use DB;
use App\Models\Category;
use App\Models\Question;

class QuestionController extends Controller
{
	private $request;          // 私有方法
	
	//路由对应方法名:
	// Verb          Path                             Action  Route Name
	// GET           /questions                      index   questions.index
	// GET           /questions/create               create  questions.create
	// POST          /questions                      store   questions.store
	// GET           /questions/{id}                 show    questions.show
	// GET           /questions/{id}/edit            edit    questions.edit
	// PUT|PATCH     /questions/{id}                 update  questions.update
	// DELETE        /questions/{id}                 destroy questions.destroy

	// 构造函数
	public function __construct (Request $request)
    {
        $this->request = $request;
    }

	// 问题列表
	public function index()
	{
		// 获取所有参数
        $reqData = $this->request->validate([
            'category_id'  => 'nullable|integer',
            'order_by'      => 'nullable|integer',
            'current_page' => 'nullable|integer',
        ]);

        $categoryId = Arr::get($reqData, "category_id");
        $orderBy = Arr::get($reqData, "order_by");
        $currentPage = Arr::get($reqData, "current_page");

        $perPage = 10;             // 分页
		$columns = ['*'];          // 纵列
		$pageName = 'page';        // 分页参数
		$total = 0;                // 总数

		// 排序规则 1 浏览次数 2 已解决次数 3 未解决次数
		if($orderBy == 1){
			$questions = Question::orderBy('viewtimes', 'desc');
		} else if($orderBy ==  2){
			$questions = Question::orderBy('resolvetimes', 'desc');
		} else if($orderBy == 3){
			$questions = Question::orderBy('unresolvetimes', 'desc');
		} else{
			$questions = Question::orderBy('create_time', 'desc');
		}

        // 判断是否返回全部问题  -1为全部
		if($categoryId == -1){
			$questions = $questions -> paginate($perPage, $columns, $pageName, $currentPage) 
				-> toArray();
		} else {
			$questions = $questions -> where('faq_category_id', $categoryId) 
				-> paginate($perPage, $columns, $pageName, $currentPage) 
				-> toArray();
		}
	 	
		$total = $questions['total'];
		
		// 判断是否超出页数，超出则返回空数组	
		if($currentPage > $questions['last_page']) {
			$questions = [];
		} else {
			$questions = $questions['data'];			
		}
		
		$categories = Category::all() -> toArray();
		$categoryList = array_column($categories, 'faq_category_name', 'id');
		foreach ($questions as &$question) {
            $question['faq_category_name'] = $categoryList[$question['faq_category_id']];
        }

		// 返回值
	 	$res = [
            "code" 	=> 0,
            "total"	=> $total,
            "msg"  	=> "成功",
            "data" 	=> $questions
        ];
		return $res;
	}

	// 创建一个问题
	public function store()
	{
		$reqData = $this->request->validate([
            'question' => 'required',              // 问题    questions
			'editor'   => 'nullable',              // 解答    answers
			'line'     => 'required',              // 产品线  product_line
			'category' => 'required',              // 分类    category_id
			'role'     => 'required',              // 权限    is_user 
			'show'     => 'required',              // 可看    is_display
			'top'      => 'required',              // 置顶    is_top 
		]);
		// 新建问题
		$question = Question::create([
            'questions'       => Arr::get($reqData, 'question'),
            'answers'         => Arr::get($reqData, 'editor'),
            'product_line'    => Arr::get($reqData, 'line'),
            'faq_category_id' => Arr::get($reqData, 'category'),
            'is_user'         => Arr::get($reqData, 'role'),
            'is_display'      => Arr::get($reqData, 'display'),
            'is_top'          => Arr::get($reqData, 'top'),
		])->toArray();

		$res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => $question
        ];
		return $res;
	}

	// 查看问题
	public function show($id)
	{
		$question = Question::findOrFail($id, ['id', 'questions', 'answers', 'product_line', 'faq_category_id', 'is_user', 'is_display', 'is_top']);
		$res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => $question
        ];
		return $res;
	}

	// 编辑问题
	public function update($id)
	{
		// 获取所有参数
		$reqData = $this->request->validate([
            'question' => 'required',              // 问题    questions
			'editor'   => 'required',              // 解答    answers
			'line'     => 'required',              // 产品线  product_line
			'category' => 'required',              // 分类    category_id
			'role'     => 'required',              // 权限    is_user 
			'show'     => 'required',              // 可看    is_display
			'top'      => 'required',              // 置顶    is_top 
		]);

		$question = question::findOrFail($id, ['id', 'questions', 'answers', 'product_line', 'faq_category_id', 'is_user', 'is_display', 'is_top']);

		// 替换更改参数
		$question['questions'] = Arr::get($reqData, 'question');
		$question['answers'] = Arr::get($reqData, 'editor');
		$question['product_line'] = Arr::get($reqData, 'line');
		$question['faq_category_id'] = Arr::get($reqData, 'category');
		$question['is_user'] = Arr::get($reqData, 'role');
		$question['is_display'] = Arr::get($reqData, 'show');
		$question['is_top'] = Arr::get($reqData, 'top');

		// 参数名相同，批量修改参数值
		// foreach($reqData  as $k => $v) {
		// 	if($k != 'product_line') {
		// 		$question[$k] = $v;
		// 	}
		// }
			
	   	$question->save();

		$res = [
            "code" => 0,
            "msg"  => "编辑成功",
            "data" => $question
        ];
		return $res;
	}

	// 删除问题
	public function destroy($id)
	{	
		$question = Question::findOrFail($id, ['id', 'questions', 'answers', 'product_line', 'faq_category_id', 'is_user', 'is_display', 'is_top']);
		$question -> delete();
		$res = [
            "code" => 0,
            "msg"  => "删除成功",
            "data" => $question
        ];
		return $res;
	}
}
