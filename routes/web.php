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
	return redirect(route('login'));
//return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// supplier menu
Route::group(['middleware' => 'auth', 'prefix' => 'supplier', 'namespace' => 'Supplier'], function () {
	Route::get('/home', [
		'uses'	=> 'SupplierHomeController@index',
		'as'	=> 'supplierhome'
	]);

	Route::get('/product', [
		'uses'	=> 'SupplierHomeController@product',
		'as'	=> 'supplierproduct'
	]);

	Route::get('/productstep1', [
		'uses'	=> 'SupplierHomeController@productstep1',
		'as'	=> 'supplierproductstep1'
	]);

	Route::get('/productstep2', [
		'uses'	=> 'SupplierHomeController@productstep2',
		'as'	=> 'supplierproductstep2'
	]);

	Route::get('/productstep3', [
		'uses'	=> 'SupplierHomeController@productstep3',
		'as'	=> 'supplierproductstep3'
	]);

	Route::get('/productstep3', [
		'uses'	=> 'SupplierHomeController@productstep3',
		'as'	=> 'supplierproductstep3'
	]);

	Route::get('/productstep4', [
		'uses'	=> 'SupplierHomeController@productstep4',
		'as'	=> 'supplierproductstep4'
	]);

	Route::get('/productstep5', [
		'uses'	=> 'SupplierHomeController@productstep5',
		'as'	=> 'supplierproductstep5'
	]);

	Route::get('/productstep6', [
		'uses'	=> 'SupplierHomeController@productstep6',
		'as'	=> 'supplierproductstep6'
	]);

	Route::get('/productstep7', [
		'uses'	=> 'SupplierHomeController@productstep7',
		'as'	=> 'supplierproductstep7'
	]);

	Route::get('/productstep8', [
		'uses'	=> 'SupplierHomeController@productstep8',
		'as'	=> 'supplierproductstep8'
	]);

	Route::get('/productstep9', [
		'uses'	=> 'SupplierHomeController@productstep9',
		'as'	=> 'supplierproductstep9'
	]);

	Route::get('/productstep10', [
		'uses'	=> 'SupplierHomeController@productstep10',
		'as'	=> 'supplierproductstep10'
	]);

	Route::get('/company', [
		'uses'	=> 'SupplierHomeController@company',
		'as'	=> 'suppliercompany'
	]);

	Route::get('/companyadd', [
		'uses'	=> 'SupplierHomeController@companyadd',
		'as'	=> 'suppliercompanyadd'
	]);

	Route::get('/brand', [
		'uses'	=> 'SupplierHomeController@brand',
		'as'	=> 'supplierbrand'
	]);

	Route::get('/brandadd', [
		'uses'	=> 'SupplierHomeController@brandadd',
		'as'	=> 'supplierbrandadd'
	]);

	Route::post('/brandaddstore', [
		'uses'	=> 'SupplierHomeController@brandaddstore',
		'as'	=> 'supplierbrandaddstore'
	]);

	Route::get('/line', [
		'uses'	=> 'SupplierHomeController@productline',
		'as'	=> 'supplierproductline'
	]);

	Route::get('/lineadd', [
		'uses'	=> 'SupplierHomeController@productlineadd',
		'as'	=> 'supplierproductlineadd'
	]);
});

//admin menu route
Route::group(['middleware' => 'auth', 'prefix' => '', 'namespace' => 'Admin'], function () {

	Route::match(['GET', 'POST'],'/supplier', [
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

	Route::get('/finishSupplier', 'SupplierController@finishSupplier')->name('finishSupplier');


	Route::get('/supplier-list', 'SupplierController@supplierList')->name('supplier-list');

	Route::get('/get_supplier_all/{id}', [
		'uses' => 'SupplierController@get_supplier_all',
		'as'   => 'get_supplier_all'
	]);

	Route::post('/update_supplier_list_data','SupplierController@update_supplier_list_data');

	Route::match(['GET', 'POST'],'/supplier-list2/{id?}', 'SupplierController@supplierList2')->name('supplier-list2');

	// supplier user permission
	Route::get('/supplierpermission', 'PermissionController@supplierpermission')->name('supplierpermission');
	Route::post('/supplierpermissionstore', 'PermissionController@supplierpermissionstore')->name('supplierpermissionstore');

	// brand manage
	Route::get('/supplier-brandedit/{id}', [
		'uses' 	=> 'BrandController@brandedit',
		'as'	=> 'brandedit'
	]);

	Route::match(['GET', 'POST'],'/supplier-brand-list', [
		'uses' 	=> 'BrandController@index',
		'as'	=> 'brand-list'
	]);

	Route::post('/brandstore', 'BrandController@brandstore')->name('brandstore');

	// Company manage
	Route::get('/supplier-companyedit/{id}', [
		'uses' 	=> 'CompanyController@companyedit',
		'as'	=> 'companyedit'
	]);

	Route::match(['GET', 'POST'],'/supplier-company-list', [
		'uses' 	=> 'CompanyController@index',
		'as'	=> 'company-list'
	]);
	
	Route::post('/companystore', 'CompanyController@companystore')->name('companystore');
	

	// supplier manage user permissions
	Route::get('/supplieruseredit/{id}', [
		'uses' 	=> 'SupplierController@supplieredit',
		'as'	=> 'supplier-data-edit'
	]);

	Route::match(['GET', 'POST'],'/supplieruserlist', [
		'uses' 	=> 'SupplierController@supplieruserlist',
		'as'	=> 'supplier-data-list'
	]);
	
	Route::post('/supplierusereditstore', 'SupplierController@supplierusereditstore')->name('supplierusereditstore');
	// Online

	Route::group(['prefix' => 'online'], function () {
		Route::get('/', 'OnlineController@orders')->name('orders');
		Route::get('/customer', 'OnlineController@customer')->name('customer');
		Route::get('/coupons', 'OnlineController@coupons')->name('coupons');
		Route::get('/reports', 'OnlineController@reports')->name('reports');
	});

	Route::group(['prefix' => 'sales'], function () {
		Route::get('/', 'SalesController@sales')->name('sales');
	});


	//Retail list
	Route::get('/retail', [
		'uses' => 'RetailController@index',
		'as'   => 'retail'
	]);

	Route::get('/retailadd', [
		'uses' 	=> 'RetailController@retailadd',
		'as'	=> 'retailadd'
	]);


	// add new user supplier add

	Route::get('/user-supplier-add', [
		'uses' 	=> 'SupplierController@usersupplieradd',
		'as'	=> 'user-supplier-add'
	]);

	Route::post('/usersupplierstore', 'SupplierController@usersupplierstore')->name('usersupplierstore');

	// add new user 

	Route::get('/add-new-user', [
		'uses' 	=> 'SupplierController@addnewuser',
		'as'	=> 'add-new-user'
	]);

	Route::post('/addnewuserstore', 'SupplierController@addnewuserstore')->name('addnewuserstore');


	// add new brand 

	Route::get('/add-new-brand', [
		'uses' 	=> 'BrandController@addnewbrand',
		'as'	=> 'add-new-brand'
	]);

	Route::post('/addnewbrandstore', 'BrandController@addnewbrandstore')->name('addnewbrandstore');

});