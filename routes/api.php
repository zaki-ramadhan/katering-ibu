<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiMenuController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiUlasanController;
use App\Http\Controllers\Api\ApiNotificationController;
use App\Http\Controllers\Api\ApiKeranjangController; // Pastikan import ini ada

// Public routes
Route::post('/login', [ApiUserController::class, 'login']);
Route::post('/register', [ApiUserController::class, 'register']);
Route::get('/menus', [ApiMenuController::class, 'index']);
Route::get('/menus/{id}', [ApiMenuController::class, 'show']);

Route::apiResource('ulasan', ApiUlasanController::class)->only(['index', 'show']);


Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/users', [ApiUserController::class, 'index']);
    Route::post('/logout', [ApiUserController::class, 'logout']);
    Route::get('/users/profile', [ApiUserController::class, 'profile']);
    Route::post('/users/update', [ApiUserController::class, 'updateProfile']);

    Route::post('/orders', [ApiOrderController::class, 'createOrder']);
    Route::get('/orders/history', [ApiOrderController::class, 'getOrderHistory']);
    Route::delete('/orders/{id}', [ApiOrderController::class, 'deleteOrder']);
    Route::get('/notifications', [ApiNotificationController::class, 'getNotifications']);

    Route::get('/keranjang', [ApiKeranjangController::class, 'index']);
    Route::post('/keranjang/add', [ApiKeranjangController::class, 'addItem']);
    Route::put('/keranjang/item/{id}', [ApiKeranjangController::class, 'updateItem']);
    Route::delete('/keranjang/item/{id}', [ApiKeranjangController::class, 'removeItem']);
    Route::delete('/keranjang/clear', [ApiKeranjangController::class, 'clearCart']);


    // Ulasan routes
    Route::apiResource('ulasan', ApiUlasanController::class)->except(['index', 'show']);
});
