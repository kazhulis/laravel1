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

Route::get('/', 'CategoryController@index')->name('categories');
Route::get('/category/{id}', 'CategoryController@show')->where('id', '[0-9]+')->name('category');
Route::get('/post/{id}', 'PostController@show')->where('id', '[0-9]+')->name('post');
Route::get('/post/new', 'PostController@create')->name('new_post');
Route::post('/post/new', 'PostController@store');
Route::get('/post/delete/{id}', 'PostController@destroy')->where('id', '[0-9]+')->name('delete');
Route::get('/post/edit/{id}', 'PostController@edit')->where('id', '[0-9]+')->name('edit');
Route::put('/post/update/{id}', 'PostController@update');
Route::get('/admin', 'AdminController@index');
Route::get('/category/create', 'CategoryController@create');
Route::post('/category/store', 'CategoryController@store');

Auth::routes();

Route::get('/home', 'PostController@index')->name('my_posts');