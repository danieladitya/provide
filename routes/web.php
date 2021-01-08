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

Route::group(['prefix' => 'sendorder'], function () {
   Route::get('/', 'SendOrderController@index')->name('sendorder.index'); 
   Route::post('/store', 'SendOrderController@store')->name('sendorder.store'); 
   Route::get('/detail/{id}', 'SendOrderController@view')->name('sendorder.view');
});

Route::group(['prefix' => 'operorder'], function () {
    Route::get('/','OperOrderController@index')->name('operoder.index');
    Route::get('/add','OperOrderController@add')->name('operoder.add');
    Route::get('/detail/{id}','OperOrderController@view')->name('operoder.view');
    Route::get('/po/{id}','OperOrderController@getProductPerPo')->name('operoder.get.poperproduct');
    Route::get('/detail/po/{id}','OperOrderController@getDetailPo')->name('operoder.get.detailpo');\

    Route::get('/print/po/{id}', 'OperOrderController@print_po')->name('operorder.print.po');

    // Route::get('/detail/{id}','OperOrderController@view')->name('operoder.get.poperproduct');
    Route::post('/store','OperOrderController@store')->name('operoder.store');
    Route::post('/update/status','OperOrderController@updateStatus')->name('operoder.update.status');
    Route::post('/update/detail','OperOrderController@updatedt')->name('operoder.update.dt');
    
});
 
Route::group(['prefix' => 'order'], function () {
    Route::get('/','OrderController@index')->name('order.index');
    Route::get('/search','OrderController@search')->name('order.search');
    Route::get('/add','OrderController@order_add')->name('order.add');
    Route::get('/view/{id}','OrderController@view')->name('order.view');
    Route::get('/print/inv/{id}','OrderController@printinvoice')->name('order.print.inv');

    Route::post('/update','OrderController@updateStatus')->name('order.update.status');
    Route::get('/AtrAddFormProduct','OrderController@AtrAddFormProduct')->name('order.AtrAddFormProduct');
    Route::post('/store', 'OrderController@store')->name('order.store');
    Route::post('/update/invoice_store', 'OrderController@invoice_store')->name('order.inv.store');

    Route::get('detail/po/vendor/{id}', 'OrderController@povendordt')->name('order.vendordt');
    
});

Route::group(['prefix' => 'master'], function () {

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/','MasterController@customer_index')->name('master.customer.index');
        Route::get('add','MasterController@customer_add')->name('master.customer.add');
        Route::get('edit/{id}','MasterController@customer_edit')->name('master.customer.edit');
        Route::get('deleted/{id}','MasterController@customer_delete')->name('master.customer.delete');
        Route::post('store','MasterController@customer_store')->name('master.customer.store');
    });
    
    Route::group(['prefix' => 'product'], function () {
        Route::get('/','MasterController@product_index')->name('master.product.index');
        Route::get('add','MasterController@product_add')->name('master.product.add');
        Route::get('edit/{id}','MasterController@product_edit')->name('master.product.edit');
        Route::get('deleted/{id}','MasterController@product_delete')->name('master.product.delete');
        Route::post('store','MasterController@product_store')->name('master.product.store');
    });

    Route::group(['prefix' => 'vendor'], function () {
        Route::get('/','MasterController@vendor_index')->name('master.vendor.index');
        Route::get('add','MasterController@vendor_add')->name('master.vendor.add');
        Route::get('edit/{id}','MasterController@vendor_edit')->name('master.vendor.edit');
        Route::get('deleted/{id}','MasterController@vendor_delete')->name('master.vendor.delete');
        Route::post('store','MasterController@vendor_store')->name('master.vendor.store');
    });

    Route::group(['prefix' => 'bank'], function () {
        Route::get('/','MasterController@bank_index')->name('master.bank.index');
        Route::get('add','MasterController@bank_add')->name('master.bank.add');
        Route::get('edit/{id}','MasterController@bank_edit')->name('master.bank.edit');
        Route::get('deleted/{id}','MasterController@bank_delete')->name('master.bank.delete');
        Route::post('store','MasterController@bank_store')->name('master.bank.store');
    });
  
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/pages', 'Admin\PagesController');
Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
    'index', 'show', 'destroy'
]);
Route::resource('admin/settings', 'Admin\SettingsController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
