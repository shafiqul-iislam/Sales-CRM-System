<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('dashboard');
    });

require __DIR__ . '/auth.php';
