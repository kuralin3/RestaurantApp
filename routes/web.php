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

// Laravelのwelcomeページ
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , 'HomeController@index');

// forgot とregisterを表示しない
Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/cashier', function() {
//     return view('cashier.index');
// });
Route::middleware(['auth'])->group(function(){
    // routes for cashier
    Route::get('/cashier', 'Cashier\CashierController@index');
    Route::get('/cashier/getMenuByCategory/{category_id}', 'Cashier\CashierController@getMenuByCategory');
    Route::get('/cashier/getTables', 'Cashier\CashierController@getTables');
    Route::get('/cashier/getSaleDetailsByTable/{table_id}', 'Cashier\CashierController@getSaleDetailsByTable');

    // POST
    Route::post('/cashier/orderFood', 'Cashier\CashierController@orderFood');

    Route::post('/cashier/confirmOrderStatus', 'Cashier\CashierController@confirmOrderStatus');
    Route::post('/cashier/savePayment', 'Cashier\CashierController@savePayment');
    Route::get('/cashier/showReceipt/{saleID}', 'Cashier\CashierController@showReceipt');

    Route::post('/cashier/deleteSaleDetail', 'Cashier\CashierController@deleteSaleDetail');
});


Route::middleware(['auth','App\Http\Middleware\VerifyAdmin'])->group(function(){
    Route::get('/management', function() {
        return view('management.index');
    });
    // controller を通すときのルーティング

    // routes for management
    Route::resource('management/category', 'Management\CategoryController');
    Route::resource('management/menu', 'Management\MenuController');
    Route::resource('management/table', 'Management\TableController');
    Route::resource('management/user', 'Management\UserController');

    // routes for report
    Route::get('/report', 'Report\ReportController@index');
    Route::get('/report/show', 'Report\ReportController@show');

    // Export 
    Route::get('/report/show/export', 'Report\ReportController@export');
});

