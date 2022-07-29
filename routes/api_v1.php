<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\ShippingServiceController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

//Auth routes
Route::put('login', LoginController::class);
Route::middleware('auth:sanctum')->put('logout', LogoutController::class);

//users routes
Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/me', 'user');

    Route::patch('/update-warehouse', 'updateWarehouse');
});

//warehouses routes
Route::middleware('auth:sanctum')->controller(WarehouseController::class)->prefix('warehouses')->group(function () {
    Route::get('/', 'index');
    Route::get('/my-warehouses', 'myWarehouses');
    Route::get('/{warehouse}', 'warehouse')->whereUuid('warehouse');

    Route::put('/store', 'store');
    Route::patch('/update/{warehouse}', 'update')->whereUuid('warehouse');
    Route::delete('/delete', 'delete');
});

//shipping services routes
Route::middleware('auth:sanctum')->controller(ShippingServiceController::class)->prefix('shipping-services')->group(function () {
    Route::get('/{shipping_service}', 'shipping_service')->whereUuid('shipping_service');
    Route::post('/store', 'store');
});
