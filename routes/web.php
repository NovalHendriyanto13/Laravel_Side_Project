<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\BloodStockController;
use App\Http\Controllers\Web\BloodController;

use App\Http\Controllers\Guest\IndexController as GuestIndexController;
use App\Http\Controllers\Guest\OrderController as GuestOrderController;

// admin site
Route::prefix('admin')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::get('/login', [AuthController::class, 'index'])->name('admin.auth.login');
        Route::get('/register', [AuthController::class, 'register'])->name('admin.auth.register');
        Route::get('/forgot', [AuthController::class, 'forgot'])->name('admin.auth.forgot');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.auth.login-action');
        Route::post('/register-action', [AuthController::class, 'registerAction'])->name('admin.auth.register-action'); 
    });

    Route::middleware(['jwt'])->group(function() {
        Route::get('/', [IndexController::class, 'index'])->name('admin.home');

        Route::prefix('auth')->group(function() {
            Route::get('/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
        });

        Route::prefix('user')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::get('/profile', [UserController::class, 'profile'])->name('admin.user.profile');
            Route::post('/profile', [UserController::class, 'profileAction'])->name('admin.user.profile-action');
            Route::post('/change-password', [UserController::class, 'changePassword'])->name('admin.user.change-password');
            Route::get('/{id}', [UserController::class, 'detail'])->name('admin.user.detail');            
        });

        Route::prefix('blood-stock')->group(function() {
            Route::get('/', [BloodStockController::class, 'index'])->name('admin.bloodStock.index');
            Route::get('/create', [BloodStockController::class, 'create'])->name('admin.bloodStock.create');
            Route::get('/{id}', [BloodStockController::class, 'detail'])->name('admin.bloodStock.detail');
        });

        Route::prefix('blood')->group(function() {
            Route::get('/', [BloodController::class, 'index'])->name('admin.blood.index');
        });

        Route::prefix('order')->group(function() {
            Route::get('/', [BloodStockController::class, 'index'])->name('admin.order.index');
            Route::get('/create', [BloodStockController::class, 'create'])->name('admin.order.create');
            Route::get('/{id}', [BloodStockController::class, 'detail'])->name('admin.order.detail');
        });
    });
});


// Guest site
Route::get('/', [GuestIndexController::class, 'index'])->name('home');
Route::get('/about', [GuestIndexController::class, 'about'])->name('about');
Route::get('/login', [GuestIndexController::class, 'login'])->name('login');
Route::get('/register', [GuestIndexController::class, 'register'])->name('register');

Route::prefix('auth')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/forgot', [AuthController::class, 'forgot'])->name('auth.forgot');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login-action');
    Route::post('/register-action', [AuthController::class, 'registerAction'])->name('auth.register-action'); 
});

Route::middleware(['auth'])->group(function() {
    
    Route::prefix('order')->group(function() {
        Route::get('/', [GuestOrderController::class, 'index'])->name('order.index');
        Route::get('/create', [GuestOrderController::class, 'create'])->name('order.create');
    });

});
