<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('sales', SaleController::class);
    });


require __DIR__ . '/auth.php';
