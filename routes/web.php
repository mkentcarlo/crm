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
		Route::get('/users', 'UserController@index')->name('view.user');
		Route::get('/users/create', 'UserController@create')->name('create.user');
		Route::post('/users/store', 'UserController@store');
		Route::get('/users/edit/{id}', 'UserController@edit')->name('edit.user');
		Route::get('/users/delete/{id}', 'UserController@delete')->name('delete.user');
		Route::post('/users/update', 'UserController@update');
		Route::get('/users/getusers', 'UserController@getUsers')->name('get.users');
		Route::get('/users/profile/{id}', 'UserController@profile')->name('edit.user.profile');
		Route::put('/users/profile/{id}', 'UserController@updateProfile')->name('update.user.profile');
		Route::get('/users/change-password/{id}', 'UserController@changePassword');
		Route::put('/users/change-password/{id}', 'UserController@updatePassword');

		Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

    	Route::get('/products', 'ProductController@index')->name('view.product');
		Route::get('/products/ajaxRequest', 'ProductController@ajaxRequest')->name('get.products');
		Route::get('/products/create', 'ProductController@create')->name('create.product');
		Route::post('/products/store', 'ProductController@store')->name('store.product');
		Route::get('/products/edit/{id}', 'ProductController@edit')->name('edit.product');
		Route::put('/products/edit/{id}', 'ProductController@update')->name('update.product');
		Route::get('/products/{id}', 'ProductController@show')->name('show.product');
		Route::delete('/products/delete/{id}', 'ProductController@destroy')->name('delete.product');

		Route::get('/categories', 'CategoryController@index')->name('view.category');
		Route::get('/categories/ajaxRequest', 'CategoryController@ajaxRequest')->name('get.categories');
		Route::post('/categories/store', 'CategoryController@store')->name('store.category');
		Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('edit.category');
		Route::put('/categories/edit/{id}', 'CategoryController@update')->name('update.category');
		Route::delete('/categories/delete/{id}', 'CategoryController@destroy')->name('delete.category');

		Route::get('/brands', 'BrandController@index')->name('view.brand');
		Route::get('/brands/ajaxRequest', 'BrandController@ajaxRequest')->name('get.brands');
		Route::post('/brands/store', 'BrandController@store')->name('create.brand');
		Route::get('/brands/edit/{id}', 'BrandController@edit')->name('edit.brand');
		Route::put('/brands/edit/{id}', 'BrandController@update')->name('update.brand');
		Route::delete('/brands/delete/{id}', 'BrandController@destroy')->name('delete.brand');

		Route::get('/groups', 'CustomerGroupController@index')->name('view.group');
		Route::get('/groups/ajaxRequest', 'CustomerGroupController@ajaxRequest')->name('get.groups');
		Route::post('/groups/store', 'CustomerGroupController@store')->name('store.group');
		Route::get('/groups/edit/{id}', 'CustomerGroupController@edit')->name('edit.group');
		Route::put('/groups/edit/{id}', 'CustomerGroupController@update')->name('update.group');
		Route::delete('/groups/delete/{id}', 'CustomerGroupController@destroy')->name('delete.group');
		
		Route::get('/customers', 'CustomerController@index')->name('view.customer');
		Route::get('/customers/ajaxRequest', 'CustomerController@ajaxRequest')->name('get.customers');
		Route::post('/customers/store', 'CustomerController@store')->name('store.customer');
		Route::get('/customers/edit/{id}', 'CustomerController@edit')->name('edit.customer');
		Route::put('/customers/edit/{id}', 'CustomerController@update')->name('update.customer');
		Route::delete('/customers/delete/{id}', 'CustomerController@destroy')->name('delete.customer');
		Route::get('/customers/{id}', 'CustomerController@show');
		Route::get('/customers/transactions/{id}', 'CustomerController@getTransactions')->name('get.transactions');

		Route::get('/invoice', 'InvoiceController@index')->name('view.invoice');
		Route::get('/invoice/ajaxRequest', 'InvoiceController@ajaxRequest')->name('get.invoices');
		Route::get('/invoice/create', 'InvoiceController@create')->name('create.invoice');
		Route::post('/invoice/store', 'InvoiceController@store')->name('store.invoice');
		Route::get('/invoice/edit/{id}', 'InvoiceController@edit')->name('edit.invoice');
		Route::post('/invoice/edit/{id}', 'InvoiceController@update')->name('update.invoice');
		Route::get('/invoice/{id}', 'InvoiceController@show')->name('show.invoice');

		Route::get('/reports', 'ReportController@index')->name('view.report');
		Route::get('/reports/ajaxRequest', 'ReportController@ajaxRequest')->name('get.reports');
		
		Route::get('/dashboard', 'HomeController@index')->name('view.dashboard');
		Route::get('/dashboard/ajaxRequest', 'HomeController@ajaxRequest')->name('get.transactions');
		Route::get('reports/view-pdf/{id}','ReportController@viewPdf')->name('view.pdf');

		Route::get('/groups/all', 'CustomerGroupController@getGroups');

		Route::get('/inquiries', 'InquiryController@index');
		Route::get('/inquiries/{id}', 'InquiryController@show');
		Route::get('/inquiries/action/marks', 'InquiryController@marks');
		Route::get('/inquiries/action/delete/{id}', 'InquiryController@deleteInquiry');
		Route::get('/inquiries/action/status/{id}', 'InquiryController@inquiryStatus');

		Route::group(['middleware' => ['role:super admin']], function () {
	    	Route::get('/roles', 'RolePermissionController@index')->name('view.role');
			Route::get('/roles/ajaxRequest', 'RolePermissionController@ajaxRequest')->name('get.roles');
			Route::post('/roles/store', 'RolePermissionController@store')->name('store.role');
			Route::get('/roles/edit/{id}', 'RolePermissionController@edit')->name('edit.role');
			Route::put('/roles/edit/{id}', 'RolePermissionController@update')->name('update.role');
			Route::delete('/roles/delete/{id}', 'RolePermissionController@destroy')->name('delete.role');
	    });	
    }
);	