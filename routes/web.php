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

/*
    Note for in the codebuild process im injecting the app version so
    that we can make sure if we are running the up to date version
    so creating this health_check so that you don have to worry
    about catching your domain not found error for now - Warrence Lim
*/
Route::get('/health_check', function () {
    return env('APP_VERSION');
});

Route::get('/getPortfolio', 'WebsiteController@getPortfolio');

// TODO this should be deleted later because we'd better use whitelist later on - Albert
Route::get('/', 'WebsiteController@index');
// TODO add this later when authentication is way is known ->middleware('auth')
Route::get('/{any}', 'WebsiteController@index')->where('any', '.*');
