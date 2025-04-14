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

use Modules\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::prefix('user')->group(function() {
//     Route::get('/', 'UserController@index');
// });

Route::prefix('user')->name('user.')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('logout', [UserController::class, 'logout'])->middleware(['auth:sanctum', 'check-token-expiration']);
    Route::get('home', [UserController::class, 'home'])->middleware(['auth:sanctum', 'check-token-expiration']);
});


