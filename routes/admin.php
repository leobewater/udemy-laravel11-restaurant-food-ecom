<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
    'prefix' => 'admin',
    // 'middleware' => ['auth', 'role:admin'],
    'as' => 'admin'
    ],
    function () {
        // Auth Routes
        Route::get('/login', [AdminAuthController::class,'index'])->name('admin.login');

        Route::get('/dashboard', [AdminDashboardController::class,'index'])
            ->name('dashboard');
    }
);
