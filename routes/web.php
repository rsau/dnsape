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

Route::get('/','ApeController@welcome');
Route::get('/privacy','ApeController@privacy');
Route::get('/updates','ApeController@updates');
Route::post('/darkmode','ApeController@darkMode');

// tools
Route::post('/dns','ApeController@dns');
Route::post('/traversal','ApeController@traversal');
Route::post('/cache','ApeController@cache');
Route::post('/httpheaders','ApeController@httpHeaders');
Route::post('/whois','ApeController@whois');
Route::post('/ipwhois','ApeController@ipwhois');
Route::post('/rbl','ApeController@rbl');
Route::post('/ping','ApeController@ping');

