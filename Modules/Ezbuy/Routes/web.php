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
Route::get('/contactus', 'EzbuyController@contactus')->name('/contactus');
Route::post('/muatnaikgambar', 'EzbuyController@storeImage');
Route::post('/refundupdate', 'EzbuyController@refundupdate')->name('refundupdate');
Route::post('/contactsubmit', 'EzbuyController@contactsubmit')->name('contactsubmit');
Route::post('/updatestatus', 'EzbuyController@updatestatus')->name('updatestatus');
Route::post('/manualupdate', 'EzbuyController@manualupdate')->name('manualupdate');
Route::get('/flow', function () { return view('ezbuy::flow'); });
Route::get('/faqs', function () { return view('ezbuy::faqs'); });

Route::prefix('ezbuy')->group(function() {
    Route::get('/', 'EzbuyController@index');
    Route::get('/create', 'EzbuyController@create');
    Route::post('/create', 'EzbuyController@store');

    Route::get('/item/{id}', 'EzbuyController@show')->name('ezbuy.item');
});

Route::prefix('api')->group(function() {
    Route::post('/addSearch', 'EzbuyController@addSearch');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/watchlist', 'EzbuyController@watchlist')->name('watchlist');
    Route::get('/orderlist', 'EzbuyController@orderlist')->name('orderlist');
});
Route::get('/paycheck', '\App\Http\Controllers\BillplzController@paycheck')->name('payment.paycheck');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/allorderlist', 'EzbuyController@allorderlist')->name('allorderlist');
    Route::get('/manualorderlist', 'EzbuyController@manualorderlist')->name('manualorderlist');
});