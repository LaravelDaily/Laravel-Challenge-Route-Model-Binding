<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;



Route::redirect('/', '/transactions');

Route::get('transactions/{transaction}/export',
    [TransactionController::class, 'export'])
    ->name('transactions.export');

Route::resource('transactions', TransactionController::class);

Route::get('transactions/{transaction:uuid}/duplicate',
    [TransactionController::class, 'duplicate'])
    ->name('transactions.duplicate');
