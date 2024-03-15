<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'as' => 'admin.'],
    function () {
        // For guest, this avoid regular user logged in and go to admin/login page
        Route::middleware(['guest'])->group(function () {
            // Auth Routes
            Route::get('/login', [AdminAuthController::class,'index'])->name('login');
            Route::get('admin/forget-password', [AdminAuthController::class, 'forgetPassword'])->name('forget-password');
        });

        // Admin Only Routes
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Profile Routes
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
            Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

            Route::resource('/slider', SliderController::class);
            Route::put('/why-choose-title-update', [WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
            Route::resource('/why-choose-us', WhyChooseUsController::class);
            Route::resource('/category', CategoryController::class);
        });
    }
);
