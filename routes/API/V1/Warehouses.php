<?php

use App\Http\Controllers\API\V1\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Warehouses Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->controller(WarehouseController::class)->prefix('warehouses')->group(function () {
    Route::get('/', 'index');
    Route::get('/my-warehouses', 'myWarehouses');
    Route::get('/{warehouse}', 'warehouse')->whereUuid('warehouse')->name('warehouses.id');

    Route::put('/store', 'store');
    Route::patch('/update/{warehouse}', 'update')->whereUuid('warehouse');
    Route::delete('/delete', 'delete');
});
