<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('books', [BookController::class, 'index']);
Route::post('books', [BookController::class, 'store']);
Route::delete('books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
