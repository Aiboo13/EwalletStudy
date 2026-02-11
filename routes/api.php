<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\WalletsController;
use GuzzleHttp\Middleware;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('jwt')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('me', [AuthController::class, 'me'])->name('me');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    });
});

Route::prefix('v1')->group(function(){
    Route::middleware('jwt')->group(function () {
        Route::get('/wallet', [WalletsController::class, 'index'])->name('index');
        Route::post('/wallet/deposit', [WalletsController::class, 'deposit'])->name('wallet.deposit');
        Route::post('/wallet/withdraw', [WalletsController::class, 'withdraw'])->name('wallet.withdraw');
    });
});



