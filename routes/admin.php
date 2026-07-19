<?php

use App\Http\Controllers\Admin\CustomerAssignmentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        
        Route::get('customers/lost', [CustomerController::class, 'lostCustomers'])->name('customers.lost');
        Route::resource('customers', CustomerController::class);

        Route::resource('employees', EmployeeController::class);
        Route::resource('sales', SaleController::class);

        Route::post('customers/{customer}/assign', [CustomerAssignmentController::class, 'store'])->name('customers.assign');
        Route::post('customers/{customer}/promotion', [CustomerController::class, 'sendPromotion'])->name('customers.promotion');
    });


require __DIR__ . '/auth.php';
