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


Route::get('login-work', 'WorkController@workLogin');
Route::get('transaction-report', 'WorkController@transactionReport');
Route::get('transaction-query', 'WorkController@transactionQuery');
Route::get('transaction-get', 'WorkController@getTransaction');
Route::get('client-get', 'WorkController@getClient');