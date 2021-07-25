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

//passing correct model parameter {transaction}
Route::get('transactions/{transaction}/export',
    [TransactionController::class, 'export'])
    ->name('transactions.export');

Route::resource('transactions', TransactionController::class);


//With missing function callBack i faced an error regards cookies
//I found a solution of passing response() method and it works
Route::get('transactions/{transaction}/duplicate',
    [TransactionController::class, 'duplicate'])
    ->name('transactions.duplicate')
    ->missing(function(){
    	return response()->view('transactions.notfound');
    });
