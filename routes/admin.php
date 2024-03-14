<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
    'as' => 'admin'
    ],
    function () {
        Route::get('dashboard', [AdminDashboardController::class,'index'])
            ->name('dashboard');
    }
);
