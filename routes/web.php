<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index');


Auth::routes();
//
Route::group(['prefix' => '/api/blog'],  function () {
    Route::post('/categories', 'CategoryController@index');
    Route::post('/createCategory','CategoryController@store');
    Route::get('/getCategory', 'CategoryController@edit');
    Route::delete('/deleteCategory','CategoryController@destroy');
    // get Categories for blog
    Route::get('/getBlogCategories','PostController@getBlogCategories');
    Route::get('/posts','PostController@posts');
    Route::post('/createPost','PostController@createBlogPost');
    Route::delete('/deletePost','PostController@deletePost');
});



