<?php

namespace App\Http\Controllers\FaqAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	// 常见问题管理后台主页
	public function index(){
		return view('faqadmin.index');
	}
}
