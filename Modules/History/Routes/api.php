<?php


use Illuminate\Support\Facades\Route;
use Modules\History\Http\Controllers\ApiSearchHistoryController;

Route::name('history.')->prefix('history')->middleware(['auth:sanctum', 'check-token-expiration', 'throttle:15,1'])->group(function () {
    // Route::get('historySearth', ['uses' => 'ApiSearchHistoryControllerhistorySearth', 'as', 'historySearth']);
    Route::get('historySearth', [ApiSearchHistoryController::class, 'historySearth']);

});
