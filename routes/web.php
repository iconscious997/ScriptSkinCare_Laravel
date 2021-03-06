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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin menu route
Route::group(['middleware' => 'auth', 'prefix' => '', 'namespace' => 'Admin'], function () {

	Route::get('/supplier', [
		'uses' => 'SupplierController@supplierList',
		'as'   => 'supplier'
	]);

	Route::get('/supplieradd', [
		'uses' 	=> 'SupplierController@supplieradd',
		'as'	=> 'supplieradd'
	]);

	Route::get('/customers', [
		'uses' => 'CustomerController@index',
		'as'   => 'customers'
	]);

	Route::get('/customeractivedeactive/{id}/{status}', [
		'uses' => 'CustomerController@customeractivedeactive',
		'as'   => 'customeractivedeactive'
	]);

	
	Route::get('/customeradd', [
		'uses' 	=> 'CustomerController@customeradd',
		'as'	=> 'customeradd'
	]);

	Route::get('/customeredit/{id}', [
		'uses' 	=> 'CustomerController@customeredit',
		'as'	=> 'customeredit'
	]);

	Route::post('/customerstore', 'CustomerController@customerstore')->name('customerstore');

	Route::get('/supplierstep1', 'SupplierController@supplierstep1')->name('supplierstep1');
	Route::post('/supplierstep1store', 'SupplierController@supplierstep1store')->name('supplierstep1store');

	Route::get('/get_list_of_supplier/{id}', [
		'uses' => 'SupplierController@get_list_of_supplier',
		'as'   => 'get_list_of_supplier'
	]);

	Route::get('/supplierstep2/{id?}', 'SupplierController@supplierstep2')->name('supplierstep2');
	Route::post('/supplierstep2store', 'SupplierController@supplierstep2store')->name('supplierstep2store');

	Route::get('/supplierstep3/{id?}', 'SupplierController@supplierstep3')->name('supplierstep3');
	Route::post('/supplierstep3store', 'SupplierController@supplierstep3store')->name('supplierstep3store');

	Route::get('/supplierstep4', 'SupplierController@supplierstep4')->name('supplierstep4');
	Route::post('/supplierstep4store', 'SupplierController@supplierstep4store')->name('supplierstep4store');


	Route::get('/supplier-list', 'SupplierController@supplierList')->name('supplier-list');
	Route::get('/supplier-list2', 'SupplierController@supplierList2')->name('supplier-list2');

	// supplier user permission
	Route::get('/supplierpermission', 'PermissionController@supplierpermission')->name('supplierpermission');
	Route::post('/supplierpermissionstore', 'PermissionController@supplierpermissionstore')->name('supplierpermissionstore');

});