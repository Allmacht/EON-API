<?php

use App\Http\Controllers\API\V1\ShippingServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Shipping services Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->controller(ShippingServiceController::class)->prefix('shipping-services')->group(function () {
    Route::get('/', 'index');
    Route::get('/{shipping_service}', 'shipping_service')->whereUuid('shipping_service');
    Route::post('/store', 'store');
    Route::post('/update/{shipping_service}', 'update')->whereUuid('shipping_service');
    Route::delete('/delete/{shipping_service}', 'delete')->whereUuid('shipping_service');
});
