<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Weather\Http\Controllers\WeatherController;

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


Route::name('weather.')->prefix('weather')->middleware(['auth:sanctum', 'check-token-expiration', 'throttle:10,1'])->group(function () {
    Route::post('weatherclimate', [WeatherController::class, 'show']);
});
