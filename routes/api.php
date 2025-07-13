<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodStockController;
use App\Http\Controllers\Api\BloodController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;

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

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('api.user.index');
        Route::post('/create', [UserController::class, 'create'])->name('api.user.create');
        Route::put('/profile', [UserController::class, 'profile'])->name('api.user.update-profile');
        Route::put('/change-password', [UserController::class, 'changePassword'])->name('api.user.change-password');
        Route::get('/{id}', [UserController::class, 'detail'])->name('api.user.detail');
        Route::put('/{id}', [UserController::class, 'update'])->name('api.user.update');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('api.order.index');
        Route::post('/create', [OrderController::class, 'create'])->name('api.order.create');
    });
});