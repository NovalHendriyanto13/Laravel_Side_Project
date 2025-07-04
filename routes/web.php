<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\BloodStockController;
use App\Http\Controllers\Web\BloodController;

Route::prefix('auth')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/forgot', [AuthController::class, 'forgot'])->name('auth.forgot');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login-action');
    Route::post('/register-action', [AuthController::class, 'registerAction'])->name('auth.register-action'); 
});


Route::middleware(['jwt'])->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('home');

    Route::prefix('auth')->group(function() {
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [UserController::class, 'profileAction'])->name('user.profile-action');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password');
    });

    Route::prefix('blood-stock')->group(function() {
        Route::get('/', [BloodStockController::class, 'index'])->name('bloodStock.index');
        Route::get('/create', [BloodStockController::class, 'create'])->name('bloodStock.create');
    });

    Route::prefix('blood')->group(function() {
        Route::get('/', [BloodController::class, 'index'])->name('blood.index');
    });
});