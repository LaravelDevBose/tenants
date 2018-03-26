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

Route::group(['middleware'=>['auth:web']], function(){
    Route::resource('tenants', 'TenantController');
    Route::get('tenants/delete/{id}','TenantController@destroy');

    Route::resource('expenses', 'ExpenseController');
    Route::get('expenses/delete/{id}','ExpenseController@destroy');
    Route::get('expenses/search-{from}-{to}','ExpenseController@expenseSearch');

    Route::prefix('payments')->group(function(){
        Route::get('/','PaymentController@index')->name('payments.index');
        Route::get('/store','PaymentController@store')->name('payments.store');
    });

    Route::prefix('expenses/type')->group(function (){
        Route::get('/store','ExpenseController@expenseTypeStore')->name('expensesType.store');
        Route::get('/update/{id}','ExpenseController@expenseTypeUpdate')->name('expensesType.update');
        Route::get('/delete/{id}','ExpenseController@expenseTypeDelete')->name('expensesType.delete');
    });

    Route::prefix('report')->group(function (){

        Route::get('/', 'ReportController@index')->name('report.index');
        Route::post('/download', 'ReportController@download_report')->name('report.download');
    });
});
