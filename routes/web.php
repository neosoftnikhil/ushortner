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
*/


Auth::routes();

Route::get('/upgrade-plan', ['as' => 'upgradePlan', 'uses' => 'DashboardController@index']);
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::post('user_plan/store', ['as' => 'userPlanStore', 'uses' => 'UserPlanController@store']);

/*
 *  Cancer Type module
 *  get files from resources/views/shortner
 * */
Route::group(array('prefix' => 'shortner', 'as' => 'Shortner::'), function() {
    Route::any('/', ['as' => 'indexShortner', 'uses' => 'ShortnerController@index']);
    Route::post('datatable', ['uses' => 'ShortnerController@datatable']);
    Route::get('add', ['as' => 'createShortner', 'uses' => 'ShortnerController@create']);
    Route::get('edit/{id}', ['as' => 'editShortner', 'uses' => 'ShortnerController@edit']);
    Route::post('store', ['as' => 'storeShortner', 'uses' => 'ShortnerController@store']);
    Route::post('update', ['as' => 'updateShortner', 'uses' => 'ShortnerController@update']);
    Route::post('delete', ['as' => 'deleteShortner', 'uses' => 'ShortnerController@delete']);
    Route::post('change_status', ['uses' => 'ShortnerController@changeStatus']);
});
Route::get('/{short_url}', ['uses' => 'DashboardController@redirectShortUrl']);