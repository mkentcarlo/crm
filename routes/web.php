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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Dashboard
Route::get('/', 'HomeController@index')->name('home');

//Users
Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/create', 'UserController@create');
Route::post('/users/store', 'UserController@store');
Route::get('/users/edit/{id}', 'UserController@edit');
Route::get('/users/delete/{id}', 'UserController@delete');
Route::post('/users/update', 'UserController@update');
Route::get('/users/getusers', 'UserController@getUsers')->name('get.users');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );