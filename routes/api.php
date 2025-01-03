<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentsController;
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

    // ini user yang sedang login

    Route::get('/user', fn(Request $request) =>  $request->user());

    // ini kalau kita mau ambil id
    // Route::get('/user', fn(Request $request) =>  $request->user()->id);

    Route::middleware(['role:admin,staff'])->group(function (){
        // Route::post('/books', [BookController::class, 'store']);
        // Route::post('/genres', [GenreController::class, 'store']);
        // Route::put('/genres/{id}', [GenreController::class, 'update']);
        // Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update','destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store','update', 'destory']);



    });

    Route::apiResource('/payment_methods', PaymentMethodController::class)->only(['index', 'show']);


    //tugas 2 Januari 2025//crud admin staff
    // customer read aja
    Route::middleware(['role:customer'])->group(function (){

    });

    Route::middleware(['role:staff,admin'])->group(function (){
        Route::apiResource('/payment_methods', PaymentMethodController::class)->only(['store','update','destroy']);

    });

    Route::middleware(['role:staff,admin'])->group(function (){
        Route::apiResource('/payments', PaymentsController::class)->only(['store','update','destroy']);

    });


    // payments
    // Route::middleware(['role:staff'])->group(function (){
    //     Route::apiResource('/payments', PaymentMethodController::class)->only(['index','show','store']);
    // });

    // Route::middleware(['role:admin'])->group(function (){
    //     Route::apiResource('/payments', PaymentMethodController::class)->only(['destroy']);
    // });

    // Route::middleware(['role:customer'])->group(function (){
    //     Route::apiResource('/payments', PaymentMethodController::class)->only(['index', 'store']);
    // });
});

Route::middleware(['role:customer'])->group(function (){
    Route::apiResource('/orders', OrderController::class);
});



//ini yang bisa di akses oleh orang lain
Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);


// orders
// Route::apiResource('/orders', OrderController::class);

// Route::get('/tes', function(){
//     // return uniqid();

//     // ini saya mau huruf nya besar
//     return "ORD-" .strtoupper(uniqid());
// });


Route::apiResource('/orders', OrderController::class);
// ini kita testing di postman

// tugas
// Route::apiResource('/payments', PaymentController::class)->only(['index', 'show']);
