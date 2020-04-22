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

Route::get('getPortfolio', 'WebsiteController@getPortfolio');

Route::group(['prefix' => 'api'], function () {
    Route::post('login-client', 'ApiController@loginClient')->name('login.client');
    Route::post('register', 'ApiController@registerClient')->name('register.client');
    Route::get('logout', 'ApiController@logout')->name('logout');
    Route::post('verify-bank-details', 'ApiController@verifyBankDetails')->name('verify.bank_details');
    Route::post('check-verification-status', 'ApiController@checkVerificationStatus')->name('verify.status');
});

// Health Check for checking deployed version - Warrence Lim
Route::get('/health_check', function () {
    return env('APP_VERSION');
});

// TODO this should be deleted later because we'd better use whitelist later on - Albert
Route::get('/', 'WebsiteController@index');
// TODO add this later when authentication is way is known ->middleware('auth')
Route::get('/{any}', 'WebsiteController@index')->where('any', '.*');
