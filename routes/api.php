<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * @author toannguyen.dev
 * @todo API extends
 * @var 2021-08-11
 */
Route::group(['middleware' => []], function () {
    /*internal*/
    Route::get('api/get/province/{option?}', 'APIController@get_province')->name('api.get.province');
    Route::get('api/get/district', 'APIController@get_district')->name('api.get.district');
    Route::get('api/get/ward', 'APIController@get_ward')->name('api.get.ward');
});
Route::group(['middleware' => []], function () {
    Route::get('api/{object}/{action?}/{option?}', 'APIController@api');
});