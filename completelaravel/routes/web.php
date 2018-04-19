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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');

Route::post("/posts/update","PostController@update")->name('posts.update');

Route::post("/posts/delete/","PostController@destroy")->name('posts.destroy');

Route::resource('/categories','CategoryController');

Route::resource('/tags','TagController');
