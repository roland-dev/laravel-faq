<?php

namespace App\Http\Controllers\FaqAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Models\Category;
use App\Models\Question;
use App\Models\ProductLine;

class IndexController extends Controller
{
	/** 常见问题管理后台列表*/
	public function index()
	{	
		// 获取所有分类
		$categories = Category::all();
		$categoryList = $categories -> toArray();

		$lines = Productline::all();

		// 获取所有问题
		$questions = Question::paginate(10);
		$questionList = $questions -> toArray();
		// dd($questionList);
		// 根据分类id绑定分类名称
		$categoryList = array_column($categoryList, 'faq_category_name', 'id');
	 	foreach ($questionList['data'] as &$question) {
            $question['faq_category_name'] = $categoryList[$question['faq_category_id']];
        }
		$lastPage = $questionList['last_page'];
		$questions = $questionList['data'];
		// dd($questions);

		return view('faqadmin.index', compact('categories', 'questions', 'lines', 'lastPage'));
	}

	/** 分类列表*/
	public function rank()
	{
		// 获取所有产品线
		$lines = Productline::all();
		$categories = Category::paginate(10);
		$categoryArr = $categories -> toArray();
		$lastPage = $categoryArr['last_page'];

		// 根据产品参数获取分类列表
		return view('faqadmin.rank_list', [
			'lines' => $lines, 
			'categories' => $categories,
			'last_page'=>$lastPage
		]);
	}

	/** 关联分类名*/
    public function attachCategoryToQuestionList(array $questionList, array $categoryList)
    {
        $categoryList = array_column($categoryList, 'name', 'code');
        foreach ($articleList as &$article) {
            $article['category_name'] = $categoryList[$article['category_code']];
            $article['sub_category_name'] = $subCategoryList[$article['sub_category_code']];
        }

        return $articleList;
    }

}
