<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{id}', [GenreController::class, 'show']);

Route::post('/genres', [GenreController::class, 'store']);
Route::get('/genres', [GenreController::class, 'index']);
// ini untuk mencari id nya
Route::get('/genres/{id}', [GenreController::class, 'show']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::get('/authors/{id}', [GenreController::class, 'show']);