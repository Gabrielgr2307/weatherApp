<?php


use Modules\Weather\Http\Controllers\WeatherController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::prefix('weatherBlade')->name('weatherBlade.')->middleware(['auth', 'throttle:10,1'])->group(function () {
        Route::post('weatherclimate', [WeatherController::class, 'showBlade']);
    });
});
