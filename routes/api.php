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

Route::group(['prefix' => 'currency'], function () {
    // Route::resource('/', CurrencyController::class);
    Route::get('/', 'App\Http\Controllers\CurrencyController@index');
    Route::post('/convert', 'App\Http\Controllers\CurrencyController@convertCurrency');
});

