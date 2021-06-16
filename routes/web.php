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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
Route::get('/', ['as' => 'home', 'uses' => 'EnquiryController@index']);
Route::post('/store', ['as' => 'storeEnquiry', 'uses' => 'EnquiryController@store']);

/*
 *  Cancer Type module
 *  get files from resources/views/cancer_type
 * */
Route::group(array('prefix' => 'cancer_type', 'as' => 'CancerType::'), function() {
    Route::any('/', ['as' => 'indexCancerType', 'uses' => 'CancerTypeController@index']);
    Route::post('datatable', ['uses' => 'CancerTypeController@datatable']);
    Route::get('add', ['as' => 'createCancerType', 'uses' => 'CancerTypeController@create']);
    Route::get('edit/{id}', ['as' => 'editCancerType', 'uses' => 'CancerTypeController@edit']);
    Route::post('store', ['as' => 'storeCancerType', 'uses' => 'CancerTypeController@store']);
    Route::post('update', ['as' => 'updateCancerType', 'uses' => 'CancerTypeController@update']);
    Route::post('delete', ['as' => 'deleteCancerType', 'uses' => 'CancerTypeController@delete']);
});

/*
 *  Doctor module
 *  get files from resources/views/user
 * */
Route::group(array('prefix' => 'doctor', 'as' => 'user::'), function() {
    Route::any('/', ['as' => 'indexUser', 'uses' => 'UserController@index']);
    Route::get('add', ['as' => 'createUser', 'uses' => 'UserController@create']);
    Route::get('edit/{id}', ['as' => 'editUser', 'uses' => 'UserController@edit']);
    Route::post('delete', ['as' => 'deleteUser', 'uses' => 'UserController@delete']);
    Route::post('store', ['as' => 'storeUser', 'uses' => 'UserController@store']);
    Route::post('update', ['as' => 'updateUser', 'uses' => 'UserController@update']);
    Route::post('datatable', ['uses' => 'UserController@datatable']);
});

/*
 *  Enquiry module
 *  get files from resources/views/enquiry
 * */
Route::group(array('prefix' => 'enquiry', 'as' => 'enquiry::'), function() {
    Route::any('/', ['as' => 'indexUser', 'uses' => 'EnquiryController@view']);
    Route::get('edit/{id}', ['as' => 'editUser', 'uses' => 'EnquiryController@edit']);
    Route::post('delete', ['as' => 'deleteUser', 'uses' => 'EnquiryController@delete']);
    Route::post('update', ['as' => 'updateUser', 'uses' => 'EnquiryController@update']);
    Route::post('datatable', ['uses' => 'EnquiryController@datatable']);
});

Route::post('/plan/store', ['as' => 'storePlan', 'uses' => 'PlanController@store']);
Route::get('/download/{id}', ['as' => 'downloadPlan', 'uses' => 'PlanController@download']);
