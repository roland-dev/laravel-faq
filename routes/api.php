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
// A RESTful接口路由方式

//路由对应方法名:
// Verb          Path                             Action  Route Name
// GET           /users                           index   categories.index
// GET           /categories/create               create  categories.create
// POST          /categories                      store   categories.store
// GET           /categories/{user}               show    categories.show
// GET           /categories/{user}/edit          edit    categories.edit
// PUT|PATCH     /categories/{user}               update  categories.update
// DELETE        /categories/{user}               destroy categories.destroy

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 问题是否已解决
Route::post('/faq/solve', 'Faq\ApiController@solve');
Route::post('/faq/search', 'Faq\ApiController@search');



Route::resource('/faq/categories', 'FaqAdmin\CategoryController');

Route::resource('/faq/questions', 'FaqAdmin\QuestionController');
