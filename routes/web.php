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
// Route::resource('/dashboard/depots','DepotController');
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('depots', 'DepotController@index')->name('depots');
    Route::get('/depots/create', 'DepotController@create')->middleware('is_admin');
    Route::get('/depots/delete/{id}', 'DepotController@destroy')->middleware('is_admin');
    Route::post('depots', 'DepotController@store');

    
    Route::get('/transactions', 'TransactionsController@index')->name('dashboard.transactions')->middleware('is_admin');
    Route::put('/transactions', 'TransactionsController@updateStatus')->name('transactions.status')->middleware('is_admin');
    Route::get('/transactions/pickup/pdf', 'TransactionsController@pickupPdf')->name('pickup.pdf')->middleware('is_admin');
    Route::get('/transactions/pickup/csv', 'TransactionsController@pickupCsv')->name('pickup.csv')->middleware('is_admin');
    Route::get('/transactions/bin/pdf', 'TransactionsController@binPdf')->name('bin.pdf')->middleware('is_admin');
    Route::get('/transactions/bin/csv', 'TransactionsController@binCsv')->name('bin.csv')->middleware('is_admin');
    Route::delete('/transactions', 'TransactionsController@destroy')->name('transactions-delete')->middleware('is_admin');
    Route::get('/transactions/create', 'TransactionsController@create')->name('transactions.create')->middleware('is_admin');
    Route::post('/transactions/create', 'TransactionsController@store')->name('transactions.store')->middleware('is_admin');

    Route::get('/request-a-bin', 'RequestBinController@index')->name('request-a-bin');
    Route::post('/request-a-bin', 'RequestBinController@store')->name('bin-create');
    Route::delete('/request-a-bin', 'RequestBinController@destroy')->name('bin-delete');

    Route::get('/request-a-pickup', 'RequestPickupController@index')->name('request-a-pickup');
    Route::post('/request-a-pickup', 'RequestPickupController@store')->name('pickup-create');
    Route::delete('/request-a-pickup', 'RequestPickupController@destroy')->name('pickup-delete');

    Route::get('client-bins', 'ClientBins@index')->name('client-bins');
});
Route::get('/dashboard/index', 'DashboardController@index')->name('dashboard.index');
Route::get('/dashboard/profile', 'ProfileController@index')->name('dashboard.profile');
Route::put('/dashboard/profile', 'ProfileController@update')->name('dashboard.profile');
Route::resource('/dashboard/bookings', 'BookingsController');

// Route::get('dashboard/client_list', 'ClientController@index')->middleware('is_admin');

Route::group(['prefix' => 'dashboard/users_list'], function () {
    Route::get('/', 'UsersController@index')->middleware('is_admin')->name('user.index');
    Route::get('/{id}', 'UsersController@show')->middleware('is_admin');
    Route::put('/update', 'UsersController@update')->middleware('is_admin')->name('user.update');
    Route::delete('/delete', 'UsersController@destroy')->middleware('is_admin')->name('user.delete');
});

Route::group(['prefix' => 'dashboard/clients_list'], function () {
    Route::get('/', 'ClientController@index')->middleware('is_admin')->name('client.index');
    Route::get('/create', 'ClientController@create')->middleware('is_admin')->name('client.create');
    Route::get('/sort', 'ClientController@sort')->middleware('is_admin')->name('client.sort');
    Route::get('/sortedpdf', 'ClientController@get_sorted_pdf')->name('client_sorted.pdf')->middleware('is_admin');
    Route::get('/map', 'ClientController@map')->middleware('is_admin')->name('client.map');
    Route::get('/booked', 'ClientController@booked')->middleware('is_admin')->name('client.booked');
    Route::post('/create', 'ClientController@store')->middleware('is_admin')->name('client.store');
    Route::get('/{id}', 'ClientController@show')->middleware('is_admin')->name('client.show');
    Route::get('/book/{id}', 'ClientController@bookpickup')->middleware('is_admin');
    Route::post('/{id}/bin', 'ClientController@addbin')->middleware('is_admin')->name('client.bin');;
    Route::put('/update', 'ClientController@update')->middleware('is_admin')->name('client.update');
    Route::delete('/delete', 'ClientController@destroy')->middleware('is_admin')->name('client.delete');
});

Route::group(['prefix' => 'dashboard/employees'], function () {
    Route::get('/', 'EmployeeController@index')->middleware('is_admin')->name('employee.index');
    Route::get('/create', 'EmployeeController@create')->middleware('is_admin')->name('employee.create');
    Route::get('/{id}', 'EmployeeController@show')->middleware('is_admin');
    Route::post('/create', 'EmployeeController@store')->middleware('is_admin')->name('employee.store');
    Route::delete('/delete', 'EmployeeController@destroy')->middleware('is_admin')->name('employee.delete');
    Route::put('/update', 'EmployeeController@update')->middleware('is_admin')->name('employee.update');
});