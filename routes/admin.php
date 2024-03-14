<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'as' => 'admin.'],
    function () {
        // Auth Routes
        Route::get('/login', [AdminAuthController::class,'index'])->name('login');

        // Admin Only Routes
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])
                ->name('dashboard');
        });
    }
);
