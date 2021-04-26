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

//login route
Route::post('login','Api\Authcontroller@login');
//register route
Route::post('register','Api\Authcontroller@register');
Route::get('logout','Api\Authcontroller@logout');

//post
Route::post('posts/create','Api\postController@create')->middleware('jwtAuth'); 
Route::post('posts/update','Api\postController@update')->middleware('jwtAuth');
Route::post('posts/delete','Api\postController@delete')->middleware('jwtAuth');
Route::get('posts','Api\postController@posts');//->middleware('jwtAuth');

Route::post('comments/create','Api\CommentsController@create')->middleware('jwtAuth'); 
Route::post('comments/update','Api\CommentsController@update')->middleware('jwtAuth');
Route::post('comments/delete','Api\CommentsController@delete')->middleware('jwtAuth');
Route::post('comments','Api\CommentsController@comments');//->middleware('jwtAuth');

Route::post('posts/like','Api\LikesController@like');