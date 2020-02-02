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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', 'PostsController@index');
Route::get('/posts/my-posts', 'PostsController@myposts');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts/create', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::put('/posts/{post}/edit', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');
