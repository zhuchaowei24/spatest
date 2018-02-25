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

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::group([  'middleware' => ['api','cors'], 'namespace' => 'VueApi'], function ($router)
{
    Route::get('/vue', 'VueController@rendering');
    Route::get('/todo/{id}', 'VueController@todo');
    Route::post('/todo_insert', 'VueController@todo_insert');
    Route::delete('/{id}/todo_delete', 'VueController@todo_delete');
    Route::patch('/{id}/todo_change', 'VueController@todo_change');
});