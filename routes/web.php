<?php
use Illuminate\Http\Request;
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




Route::get('/', 'HomeController@index')->name('home');
Route::get('/userdata', 'HomeController@showUserdata')->name('data');
Route::get('/userdata/{id}','HomeController@destroy');
Route::get('/userdata/edituser/{id}','HomeController@edit')->name('edituser');
Route::post('/userdata','HomeController@update')->name('update');
Auth::routes();
Route::get('/register', 'RegisterController@showform')->name('/register.showform');
Route::post('/register', 'RegisterController@register')->name('/register');
Route::get('/profile', 'HomeController@profile');
Route::get('/profile/profileimage', 'HomeController@show')->middleware('auth')->name('/profile/profileimage.show');
Route::post('/profile/profileimage', 'HomeController@update')->middleware('auth')->name('/profile/profileimage.update');

