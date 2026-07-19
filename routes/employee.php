<?php

use App\Http\Controllers\Employee\CustomerController;
use App\Http\Controllers\Employee\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)
            ->name('dashboard');

        Route::get('/customers', [CustomerController::class, 'index'])
            ->name('customers.index');

        Route::get('/customers/{customer}', [CustomerController::class, 'show'])
            ->name('customers.show');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
    });

require __DIR__ . '/auth.php';
