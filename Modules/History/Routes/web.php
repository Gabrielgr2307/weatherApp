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

use Illuminate\Support\Facades\Route;
use Modules\History\Http\Controllers\SearchHistoryController;

Route::prefix('history')->name('history.')->group(function () {
    Route::get('index', [SearchHistoryController::class, 'index'])->name('index');
});

