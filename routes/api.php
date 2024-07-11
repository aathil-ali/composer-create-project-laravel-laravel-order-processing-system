<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderApiController;

Route::prefix('orders')->group(function () {

    Route::post('/', [OrderApiController::class, 'createOrder']);
    Route::get('/{orderId}', [OrderApiController::class, 'getOrder']);
    Route::post('/{orderId}/fulfill', [OrderApiController::class, 'fulfillOrder']);
    Route::put('/{orderId}/status', [OrderApiController::class, 'updateOrderStatus']);

});