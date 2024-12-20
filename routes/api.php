<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/provinces', [ShippingController::class, 'getProvinces'])->middleware('auth:sanctum');
Route::post('/shipping-cost', [ShippingController::class, 'getShippingCost'])->middleware('auth:sanctum');
Route::post('/shipping/calculate', [ShippingController::class, 'calculateShipping']);
Route::post('/transactions/create', [TransactionController::class, 'createTransaction']);
Route::post('/transactions', [TransactionController::class, 'createTransaction']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/update-stock', [ProductController::class, 'updateStock']);
    Route::post('/api/update-stock', [ProductController::class, 'updateStock']);
    Route::post('/api/check-stock', [ProductController::class, 'checkStock']);
    Route::get('/products/{id}/stock', [ProductController::class, 'checkStock']);


});

Route::get('/products', [ProductController::class, 'index'])->middleware('auth:sanctum');
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});
