<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 问题是否已解决
Route::post('/faq/solve', 'Faq\ApiController@solve');
Route::post('/faq/search', 'Faq\ApiController@search');
Route::resource('/faq/categories', 'FaqAdmin\ApiController');

// Route::get('/faq/category', 'FaqAdmin\ApiController@categoryList');
// Route::get('/faq/category_view', 'FaqAdmin\ApiController@viewCategory');
// Route::post('/faq/category', 'FaqAdmin\ApiController@createCategory');
// Route::post('/faq/category_delete', 'FaqAdmin\ApiController@deleteCategory');
// Route::post('/faq/category_update', 'FaqAdmin\ApiController@updateCategory');


Route::get('/faq/question', 'FaqAdmin\ApiController@questionList');
