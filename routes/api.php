<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    //  protect route (private)
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('api.categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('api.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('api.categories.destroy');

    // 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

// public route
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('api.categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('api.categories.show');


Route::apiResource('products', ProductController::class)->names([
    'index'   => 'api.products.index',
    'store'   => 'api.products.store',
    'show'    => 'api.products.show',
    'update'  => 'api.products.update',
    'destroy' => 'api.products.destroy',
]);
