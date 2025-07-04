<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('books', [BookController::class, 'index']);
// Route::get('books/{id}', [BookController::class, 'show']);
// Route::post('books', [BookController::class, 'store']);
// Route::put('books/{id}', [BookController::class, 'update']);

// API routes for books
Route::apiResource('books', BookController::class);