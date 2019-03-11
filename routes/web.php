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

Route::get(
    '/', function () {
        return redirect('login');
    }
);

Auth::routes();

Route::group(
    ['middleware' => ['auth', 'check.permission']], function () {

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

    	Route::get('/products', 'ProductController@index')->name('products');
		Route::get('/products/ajaxRequest', 'ProductController@ajaxRequest')->name('get.products');
		Route::get('/products/create', 'ProductController@create')->name('create.product');
		Route::post('/products/store', 'ProductController@store')->name('store.product');
		Route::get('/products/edit/{id}', 'ProductController@edit')->name('edit.product');
		Route::put('/products/edit/{id}', 'ProductController@update')->name('update.product');
		Route::get('/products/{id}', 'ProductController@show')->name('view.product');
		Route::delete('/products/delete/{id}', 'ProductController@destroy')->name('delete.product');

		Route::get('/categories', 'CategoryController@index')->name('categories');
		Route::get('/categories/ajaxRequest', 'CategoryController@ajaxRequest')->name('get.categories');
		Route::post('/categories/store', 'CategoryController@store')->name('store.category');
		Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('edit.category');
		Route::put('/categories/edit/{id}', 'CategoryController@update')->name('update.category');
		Route::delete('/categories/delete/{id}', 'CategoryController@destroy')->name('delete.category');

		Route::get('/brands', 'BrandController@index')->name('brands');
		Route::get('/brands/ajaxRequest', 'BrandController@ajaxRequest')->name('get.brands');
		Route::post('/brands/store', 'BrandController@store')->name('store.brand');
		Route::get('/brands/edit/{id}', 'BrandController@edit')->name('edit.brand');
		Route::put('/brands/edit/{id}', 'BrandController@update')->name('update.brand');
		Route::delete('/brands/delete/{id}', 'BrandController@destroy')->name('delete.brand');

		Route::get('/groups', 'CustomerGroupController@index')->name('groups');
		Route::get('/groups/ajaxRequest', 'CustomerGroupController@ajaxRequest')->name('get.groups');
		Route::post('/groups/store', 'CustomerGroupController@store')->name('store.group');
		Route::get('/groups/edit/{id}', 'CustomerGroupController@edit')->name('edit.group');
		Route::put('/groups/edit/{id}', 'CustomerGroupController@update')->name('update.group');
		Route::delete('/groups/delete/{id}', 'CustomerGroupController@destroy')->name('delete.group');

		Route::get('/roles', 'RolePermissionController@index')->name('roles');
		Route::get('/roles/ajaxRequest', 'RolePermissionController@ajaxRequest')->name('get.roles');
    }
);	