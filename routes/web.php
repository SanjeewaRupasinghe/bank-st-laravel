<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('transactions/pdf', [TransactionController::class, 'pdf'])->name('transactions.pdf');
