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
//show the posts
Route::get('/posts', function (){
   return response()->json(\App\Post::all(), 200);
});
// show one post
Route::get('/post/{id}', function ($id){
    try{
        $post = \App\Post::findOrFail($id);
    }catch (Exception $exception){
        return response()->json(['Msg' => $exception->getMessage()], 404);
    }
    return response()->json($post, 200);
});

Route::post('/post', 'APIAdminController@create');

Route::put('/post/{id}', 'APIAdminController@update');

Route::delete('/42b90196b487c54069097a68fe98ab6f/{id}', function($id){
    try{
        $post = \App\Post::findOrFail($id);
    }catch (Exception $exception){
        return response()->json(['Msg' => $exception->getMessage()], 404);
    }
    $post->delete();
    return response()->json(['Msg' => $post->id . 'Пост удален'], 200);

});

