<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes version 1
|--------------------------------------------------------------------------
|
*/

//Auth routes
Route::put('login', LoginController::class);
Route::middleware('auth:sanctum')->put('logout', LogoutController::class);

//users routes
Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/me', 'user');

    Route::put('/update-warehouse', 'updateWarehouse');
});

//warehouses routes
Route::middleware('auth:sanctum')->controller(WarehouseController::class)->prefix('warehouses')->group(function () {
    Route::get('/', 'index');
    Route::get('/my-warehouses', 'myWarehouses');
    Route::get('/{warehouse}', 'warehouse');
    Route::put('/store', 'store');
});
