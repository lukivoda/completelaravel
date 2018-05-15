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

Route::resource('/posts', 'PostController');

Route::post("/posts/update","PostController@update")->name('posts.update');

Route::post("/posts/delete/","PostController@destroy")->name('posts.destroy');

Route::resource('/categories','CategoryController');

Route::post("/categories/update","CategoryController@update")->name('categories.update');

Route::post("/categories/delete","CategoryController@destroy")->name('categories.destroy');

Route::resource('/tags','TagController');

Route::post("/tags/update","TagController@update")->name('tags.update');

Route::post("/tags/delete","TagController@destroy")->name('tags.destroy');


Route::get('/',"FrontendController@index")->name('index');

Route::get('/category_posts',"FrontendController@categoryPosts")->name('category_posts');


Route::get('/post/{slug}',"FrontendController@show")->name('post.show');

Route::post("/search","FrontendController@search")->name("search");

Route::get("/autocomplete","FrontendController@autocomplete")->name("autocomplete");

Route::get("/tagged/{tag}","FrontendController@tagged")->name("tagged");

Route::get("/gallery","FrontendController@albums")->name('gallery');

Route::get("gallery/photos","FrontendController@photosById")->name('gallery.photos');


Route::get("/albums","AlbumController@index")->name('albums');

Route::post("/albums","AlbumController@store")->name('album.store');

Route::get("/albums/{id}","AlbumController@show")->name('albums.show');

Route::get("/albums/{id}/edit","AlbumController@edit")->name('albums.edit');

Route::post("/albums/update","AlbumController@update")->name('albums.update');

Route::post("/albums/delete","AlbumController@destroy")->name('albums.destroy');

Route::post("/photos","PhotoController@store")->name('photo.store');

Route::post("/photos/delete","PhotoController@destroy")->name('photos.destroy');





