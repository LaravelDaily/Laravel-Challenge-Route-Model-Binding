<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/transactions');

Route::get('transactions/{transaction}/export',
    [TransactionController::class, 'export'])
    ->name('transactions.export');

Route::resource('transactions', TransactionController::class);

Route::get('transactions/{transaction:uuid}/duplicate',
    [TransactionController::class, 'duplicate'])
    ->name('transactions.duplicate');
