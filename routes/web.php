<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\BloodStockController;
use App\Http\Controllers\Web\BloodController;
use App\Http\Controllers\Web\HospitalController;
use App\Http\Controllers\Web\OrderController;

use App\Http\Controllers\Guest\IndexController as GuestIndexController;
use App\Http\Controllers\Guest\OrderController as GuestOrderController;
use App\Http\Controllers\Guest\BloodStockController as GuestBloodStockController;

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
            Route::get('/create', [BloodController::class, 'create'])->name('admin.blood.create');
            Route::get('/{id}', [BloodController::class, 'detail'])->name('admin.blood.detail');
        });

        Route::prefix('order')->group(function() {
            Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
            Route::get('/create', [OrderController::class, 'create'])->name('admin.order.create');
            Route::get('/report', [OrderController::class, 'report'])->name('admin.order.report');
            Route::get('/payment-list', [OrderController::class, 'paymentList'])->name('admin.order.payment-list');
            Route::get('/payment/{id}', [OrderController::class, 'payment'])->name('admin.order.payment');
            Route::get('/non-bdrs/{id}', [OrderController::class, 'detailNonBdrs'])->name('admin.order.detail_non_bdrs');
            Route::get('/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');
        });

        Route::prefix('hospital')->group(function() {
            Route::get('/', [HospitalController::class, 'index'])->name('admin.hospital.index');
            Route::get('/create', [HospitalController::class, 'create'])->name('admin.hospital.create');
            Route::get('/{id}', [HospitalController::class, 'detail'])->name('admin.hospital.detail');
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
        Route::get('/create', [GuestOrderController::class, 'create'])->name('order.create.bdrs');
        Route::get('/create/non-bdrs', [GuestOrderController::class, 'createNonBdrs'])->name('order.create.non-bdrs');
        Route::get('/non-bdrs/{id}', [GuestOrderController::class, 'detailNonBdrs'])->name('order.detail-non-bdrs');
        Route::get('/{id}', [GuestOrderController::class, 'detail'])->name('order.detail');
    });

    Route::prefix('blood-stock')->group(function() {
        Route::get('/', [GuestBloodStockController::class, 'index'])->name('bloodStock.index');
    });

});
