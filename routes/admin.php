<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'as' => 'admin.'],
    function () {
        // For guest, this avoid regular user logged in and go to admin/login page
        Route::middleware(['guest'])->group(function () {
            // Auth Routes
            Route::get('/login', [AdminAuthController::class,'index'])->name('login');
        });

        // Admin Only Routes
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Profile Routes
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
            Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        });
    }
);
