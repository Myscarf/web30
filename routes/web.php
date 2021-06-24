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

Route::get('/', NewsController::class)->name('news');

Route::get('/series', function () {
    return view('series');
})->name('series');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/arcs', function () {
    return view('arcs');
})->name('arcs');

Route::get('/penciler/{key}', PostbyPenciler::class)->name('post_by_penciler');

Route::get('/post/{id}', SinglePostController::class)->name('single_post');

Route::post('/post/{id}', SaveCommentController::class)->name('save_comment');

Route::get('/character/{key}', PostsbyCharacterController::class)->name('post_by_character');

//Admin
Route::get('/admin/add_post', 'AdminPostController@add')->name('add_post_get');

Route::post('/admin/add_post', 'AdminPostController@save')->name('add_post_post');

Route::get('/admin/edit_post/{id}', 'AdminPostController@edit')->name('edit_post_get');

Route::post('/admin/edit_post/{id}', 'AdminPostController@edit_save')->name('edit_post_post');

Route::get('/admin/admin_post', 'AdminPostController@delete')->name('admin_post_get');

Route::delete('/admin/admin_post', 'AdminPostController@delete')->name('delete_post_post');

Route::get('/404', function (){
    return view('404');
})->name('404');


//Auth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Cart action

Route::get('/cart/add_to_cart/{id}', AddToCartAction::class)->name('add_to_cart');
