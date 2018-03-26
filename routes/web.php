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


Route::group(['middleware'=>['auth:web']], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('account')->group(function(){
        Route::get('setting','Auth\AccountSettingController@index')->name('account.index');
        Route::post('image/change','Auth\AccountSettingController@imageChnage')->name('image.change');
        Route::post('password/change','Auth\AccountSettingController@passwordChange')->name('password.change');
    });
    Route::resource('tenants', 'TenantController');
    Route::get('tenants/delete/{id}','TenantController@destroy');

    Route::resource('expenses', 'ExpenseController');
    Route::get('expenses/delete/{id}','ExpenseController@destroy')->name('expenses.delete');
    Route::post('expenses/search','ExpenseController@expenseSearch')->name('expenses.search');

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
    Route::prefix('rating')->group(function (){
        Route::post('/store','HomeController@ratingStore')->name('rating.store');
        Route::get('view','HomeController@ratingView')->name('rating.view');
        Route::get('show/{id}','HomeController@ratingShow')->name('rating.show');
    });

});

