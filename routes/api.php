<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodStockController;
use App\Http\Controllers\Api\BloodController;
use App\Http\Controllers\Api\OrderController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
    Route::post('/login-guest', [AuthController::class, 'loginGuest'])->name('api.auth.loginGuest');
    Route::post('/register-guest', [AuthController::class, 'registerAction'])->name('api.auth.registerGuest'); 
});

Route::middleware(['jwt'])->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('home');

    Route::prefix('auth')->group(function() {
        Route::get('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');
    });

    Route::prefix('blood-stock')->group(function() {
        Route::get('/', [BloodStockController::class, 'index'])->name('api.bloodStock.index');
        Route::post('/create', [BloodStockController::class, 'create'])->name('api.bloodStock.create');
        Route::get('/{id}', [BloodStockController::class, 'detail'])->name('api.bloodStock.detail');
        Route::put('/{id}', [BloodStockController::class, 'update'])->name('api.bloodStock.update');
    });

    Route::prefix('blood')->group(function() {
        Route::get('/', [BloodController::class, 'index'])->name('api.blood.index');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('api.order.index');
        Route::post('/create', [OrderController::class, 'create'])->name('api.order.create');
    });
});