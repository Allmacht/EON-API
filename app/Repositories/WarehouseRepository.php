<?php

namespace App\Repositories;

use App\Interfaces\WarehouseRepositoryInterface;
use App\Models\Warehouse;
use App\Models\WarehousesPerUser;
use Illuminate\Database\Eloquent\Collection;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function getWarehouses(): Collection
    {
        return Warehouse::all();
    }

    public function getMyWarehouses(string $id): Collection
    {
        $warehousesIds = WarehousesPerUser::whereUserId($id)->pluck('warehouse_id')->toArray();

        return Warehouse::whereIn('id', $warehousesIds)->get();
    }

    public function getWarehouseById(string $id): Warehouse
    {
        return Warehouse::whereKey($id)->first();
    }

    public function createWarehouse(array $params)
    {
    }

    public function updateWarehouse(string $id, array $params)
    {
    }
}
