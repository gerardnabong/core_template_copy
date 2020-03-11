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

Route::get('/getPortfolio', 'WebsiteController@getPortfolio');

// TODO this should be deleted later because we'd better use whitelist later on - Albert
Route::get('/','WebsiteController@index');
Route::get('/{any}', 'WebsiteController@index')->where('any', '.*')->middleware('auth');
