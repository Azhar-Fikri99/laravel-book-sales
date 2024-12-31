<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// di sini  tempat login dan register
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


// ini wajib login middle war atas ini
Route::middleware(['auth:api'])->group(function (){

    // ini get info (harus login dulu)


    // ini kita bisa buat menjadi arrow function
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::get('/user', fn(Request $request) =>  $request->user());

    Route::middleware(['role:admin,staff'])->group(function (){
        // Route::post('/books', [BookController::class, 'store']);
        // Route::post('/genres', [GenreController::class, 'store']);
        // Route::put('/genres/{id}', [GenreController::class, 'update']);
        // Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update','destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store','update', 'destory']);

    });
});


// books

// genres



// authors

//ini yang bisa di akses oleh orang lain
Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);


// orders
Route::apiResource('/orders', OrderController::class);