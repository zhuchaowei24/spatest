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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/token/refresh', 'Auth\LoginController@refresh');

Route::group([  'middleware' => ['api','cors'], 'namespace' => 'VueApi'], function ($router)
{
    Route::get('/vue', 'VueController@rendering');
    Route::get('/todo/{id}', 'VueController@todo');
    Route::post('/todo_insert', 'VueController@todo_insert');
    Route::delete('/{id}/todo_delete', 'VueController@todo_delete');
    Route::patch('/{id}/todo_change', 'VueController@todo_change');
});