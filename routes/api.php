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

Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'Api\UserController@details');
Route::post('update','Api\UserController@update');
Route::get('edit','Api\UserController@edit');
Route::get('profile', 'Api\UserController@profile');
});
Route::get('users', 'Api\UserController@getallusers');
Route::post('userdelete', 'Api\UserController@delete');
