<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

Auth::routes();
/**
 * 
 * 
 */
Route::group(['middleware' => ['auth']], function () {
    /*logger*/
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    /*route*/
    Route::get('routes', 'AdminDetailsController@listRoutes');
    /*test by Browser*/    
    Route::get('dev', 'AdminDetailsController@dev');

    /*example*/
    Route::get('examples/export', 'ExampleController@index')->name('examples.export');
    Route::resource('ex', 'ExampleController');
});

 /**
 * @author toannguyen
 * @todo  The role assigned by user
 * @var
 */
/*ROLE:: admin*/
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('users/export', 'UserController@index')->name('users.export');
    Route::resource('users', 'UserController');
});
/**/
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('customers/export', 'CustomerController@index')->name('customers.export');
    Route::resource('customers', 'CustomerController');
    Route::get('history_contacts/export', 'HistoryContactController@index')->name('history_contacts.export');
    Route::resource('history_contacts', 'HistoryContactController');
    Route::get('contracts/export', 'ContractController@index')->name('contracts.export');
    Route::resource('contracts', 'ContractController');
    Route::get('addendoms/export', 'AddendomController@index')->name('addendoms.export');
    Route::resource('addendoms', 'AddendomController');
    Route::get('types/export', 'TypeController@index')->name('types.export');
    Route::resource('types', 'TypeController');
    Route::get('customer_origins/export', 'CustomerOriginController@index')->name('customer_origins.export');
    Route::resource('customer_origins', 'CustomerOriginController');
    // Route::get('packages/export', 'PackageController@index')->name('packages.export');
    // Route::resource('packages', 'PackageController');
    /*dev*/
});
 /**
 * @author toannguyen
 * @todo  as the users was only authenticated. 
 * @var
 */ 
Route::group(['middleware' => ['auth']], function () {

    /* index page*/
    Route::get('/', ['as' => 'public.home', 'uses' => 'UserController@dashboard']);
    Route::get('/home', 'UserController@dashboard');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
    Route::resource('users', 'UserController')->only(['show', 'edit']);
});