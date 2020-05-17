<?php

namespace App\Http\Controllers\FaqAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Arr;
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

	// 分类列表
	public function index(Request $request)
	{
		// 获取所有参数
        $reqData = $this->request->validate([
            'product_line'    => 'nullable|integer',
            'current_page' => 'nullable|integer',
        ]);
        $line = Arr::get($reqData, "product_line");
        $currentPage = Arr::get($reqData, "current_page");

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

	// 创建一个分类
	public function create(Request $request)
	{
		$reqData = $request -> all();
		// 新建分类
		$category = Category::create([
            'faq_category_name' => $reqData['faq_category_name'],
            'sequence' => $reqData['sequence'],
		])->toArray();

		// 新增关系表
		$db = DB::table('faq_productline_to_category');
		$result = $db -> insertGetId([
    			'product_line_id' => array_get($reqData, 'product_line'),
    			'category_id' => array_get($category, 'id'),
    			'active' => 1
		]);

		$res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => $category
        ];
		return $res;
	}

	// 查看分类
	public function edit(Request $request)
	{
		// 获取所有参数
		$reqData = $request -> all();
		
		$category = Category::findOrFail(array_get($reqData, 'category_id'));
		$res = [
            "code" => 0,
            "msg"  => "成功",
            "data" => $category
        ];
		return $res;
	}

	// 编辑分类
	public function update(Request $request)
	{
		// 获取所有参数
		$reqData = $request -> all();
		
		$category = Category::findOrFail(array_get($reqData, 'category_id'));
		// dd($category);
		foreach($reqData  as $k => $v) {
			if($k != "category_id"){
				$category[$k] = $v;
			}
		}
			
	   	$category = $category->save();

		$res = [
            "code" => 0,
            "msg"  => "编辑成功",
            "data" => $category
        ];
		return $res;
	}

	// 删除分类
	public function destroy(Request $request)
	{
				// 获取所有参数
		$reqData = $request -> all();
		
		$category = Category::findOrFail(array_get($reqData, 'category_id'));
		$category -> delete();
		$res = [
            "code" => 0,
            "msg"  => "删除成功",
            "data" => $category
        ];
		return $res;
	}

	// 问题列表
	public function questionList(Request $request)
	{
		// 获取所有参数
        $reqData = $request -> all();
        $line = $reqData["product_line"];
        $category = $reqData["faq_category_id"];

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
