<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodStockController;
use App\Http\Controllers\Api\BloodController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
    Route::post('/register-action', [AuthController::class, 'registerAction'])->name('api.auth.register-action'); 
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
