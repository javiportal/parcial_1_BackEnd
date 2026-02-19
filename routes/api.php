<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/books', [BookController::class, 'index']);
Route::post('/loans', [LoanController::class, 'store']);
Route::post('/returns/{loan}', [LoanController::class, 'returnBook']);

Route::get('/loans', [LoanController::class, 'index']);