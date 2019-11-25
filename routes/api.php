<?php

use Illuminate\Http\Request;

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
Route::get('/posts', 'PostsController@index')->name('posts.index')->middleware('auth:api');
Route::delete('/post/{post}', 'PostsController@destroy')->name('posts.destroy')->middleware('auth:api');
Route::get('/categories', 'CategoriesController@index')->name('categories.index');
Route::post('/categories', 'CategoriesController@store')->name('categories.store');
Route::delete('/category/{category}', 'CategoriesController@destroy')->name('categories.destroy');
