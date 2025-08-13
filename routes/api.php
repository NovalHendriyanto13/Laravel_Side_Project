<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodStockController;
use App\Http\Controllers\Api\BloodController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\ReceiptController;

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

    Route::prefix('admin-blood-stock')->group(function() {
        Route::get('/', [BloodStockController::class, 'index'])->name('api.admin.bloodStock.index');
        Route::post('/create', [BloodStockController::class, 'create'])->name('api.admin.bloodStock.create');
        Route::get('/{id}', [BloodStockController::class, 'detail'])->name('api.admin.bloodStock.detail');
        Route::put('/{id}', [BloodStockController::class, 'update'])->name('api.admin.bloodStock.update');
    });

    Route::prefix('admin-blood')->group(function() {
        Route::get('/', [BloodController::class, 'index'])->name('api.admin.blood.index');
        Route::post('/create', [BloodController::class, 'create'])->name('api.admin.blood.create');
        Route::put('/{id}', [BloodController::class, 'update'])->name('api.admin.blood.update');
        Route::get('/{id}', [BloodController::class, 'detail'])->name('api.admin.blood.detail');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('api.user.index');
        Route::post('/create', [UserController::class, 'create'])->name('api.user.create');
        Route::put('/profile', [UserController::class, 'profile'])->name('api.user.update-profile');
        Route::put('/change-password', [UserController::class, 'changePassword'])->name('api.user.change-password');
        Route::get('/{id}', [UserController::class, 'detail'])->name('api.user.detail');
        Route::put('/{id}', [UserController::class, 'update'])->name('api.user.update');
    });

    Route::prefix('hospital')->group(function() {
        Route::get('/', [HospitalController::class, 'index'])->name('api.hospital.index');
        Route::get('/{id}', [HospitalController::class, 'detail'])->name('api.hospital.detail');
    });

    Route::prefix('admin-order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('api.admin.order.index');
        Route::post('/report', [OrderController::class, 'report'])->name('api.admin.order.report');
        Route::put('/{id}', [OrderController::class, 'update'])->name('api.admin.order.update');
        Route::get('/{id}', [OrderController::class, 'detail'])->name('api.admin.order.detail');
    });

    Route::prefix('admin-receipt')->group(function() {
        Route::post('/create', [ReceiptController::class, 'create'])->name('api.admin.receipt.create');
        Route::post('/process/{id}', [ReceiptController::class, 'process'])->name('api.admin.receipt.process');
        Route::get('/detail/{id}', [ReceiptController::class, 'detailItem'])->name('api.admin.receipt.detail.item');
        Route::get('/{id}', [ReceiptController::class, 'detail'])->name('api.admin.receipt.detail');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('api.order.index');
        Route::post('/create', [OrderController::class, 'create'])->name('api.order.create');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('api.order.update');
        Route::get('/{id}', [OrderController::class, 'detail'])->name('api.order.detail');
    });

    Route::prefix('blood')->group(function() {
        Route::get('/', [BloodController::class, 'index'])->name('api.blood.index');
    });

    Route::prefix('blood-stock')->group(function() {
        Route::get('/', [BloodStockController::class, 'index'])->name('api.bloodStock.index');
        Route::get('/ml', [BloodStockController::class, 'ml'])->name('api.bloodStock.ml');
    });
});