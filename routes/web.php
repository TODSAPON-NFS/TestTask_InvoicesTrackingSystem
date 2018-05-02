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

Route::group(['prefix' => 'invoices', 'as' => 'invoices', 'middleware' => 'auth'], function() {
    Route::get('/', 'InvoiceController@index');
    Route::post('/', 'InvoiceController@store')->name('.store');
    Route::post('/list', 'InvoiceController@list')->name('.list');
    Route::put('/{invoice}', 'InvoiceController@update')->name('.update');
    Route::delete('{invoice}', 'InvoiceController@destroy')->name('.destroy');
    Route::post('/categories/list', 'InvoiceCategoriesController@list')->name('.categories.list');
    Route::post('/statuses/list', 'InvoiceStatusesController@list')->name('.statuses.list');
});

Route::post('/customers/list', 'CustomerController@list')->name('customers.list');
Route::post('/vendors/list', 'vendorController@list')->name('customers.list');
