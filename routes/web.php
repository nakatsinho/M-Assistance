<?php

use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\WorldBankController;
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

Route::get('/', function () {
    return view('home');
});

Route::resource('weather', WeatherController::class);

//The routes above was used to make test during the development process
Route::resource('exchange-rates', ExchangeRateController::class);
Route::resource('world-bank', WorldBankController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
