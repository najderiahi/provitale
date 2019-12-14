<?php


Route::put('/post/{post}', 'PostsController@update')->name('posts.update');


// Page d'accueil

Route::get('/', 'CategoryPostsController@index')->name('landing.page');

// Connexion
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/home', 'HomeController@index')->name('home');

// Search
Route::get('/search', 'SearchPostsController@index')->name('search');

Route::post('/posts', 'PostsController@store')->name('posts.store');


Route::get('/categories', 'HomeController@categories')->name('categories');
Route::put('/category/{category}', 'CategoriesController@update')->name('categories.update')->middleware('auth');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/categories/{category}/posts', 'CategoryPostsController@show')->name('categories.show');

Route::view('/about', 'misc.about');
Route::view('/contact', 'misc.contact');
