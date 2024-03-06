<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('auth')->group(function () {
    Route::post('email', [\App\Auth\Controllers\AuthController::class, 'email'])->name('auth.email');
    Route::post('register', [\App\Auth\Controllers\AuthController::class, 'registerViaEmail'])
        ->name('auth.register');
    Route::post('logout', [\App\Auth\Controllers\AuthController::class, 'logout'])
        ->name('auth.logout');

    Route::prefix('google')->group(function () {
        Route::get('/', [\App\Auth\Controllers\GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
        Route::get('/callback', [\App\Auth\Controllers\GoogleAuthController::class, 'handleGoogleCallback']);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('me', [\App\Auth\Controllers\AuthController::class, 'me'])->name('me');
});
