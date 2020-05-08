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

		return view('faqadmin.index');
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

}
