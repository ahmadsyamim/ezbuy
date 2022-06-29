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
// dd(Request::path());
Route::get('/', 'EzbuyController@index')->name('/');
Route::prefix('ezbuy')->group(function() {
    Route::get('/', 'EzbuyController@index');
    Route::get('/create', 'EzbuyController@create');
    Route::post('/create', 'EzbuyController@store');

    Route::get('/item/{id}', 'EzbuyController@show')->name('ezbuy.item');
});

Route::prefix('api')->group(function() {
    Route::post('/addSearch', 'EzbuyController@addSearch');
});