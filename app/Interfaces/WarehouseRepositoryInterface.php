<?php

namespace App\Interfaces;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Collection;

interface WarehouseRepositoryInterface
{
    public function getWarehouses(): Collection;

    public function getMyWarehouses(string $id): Collection;

    public function getWarehouseById(string $id): ?Warehouse;

    public function storeWarehouse(array $params): Warehouse;

    public function updateWarehouse(string $id, array $params): bool;

    public function deleteWarehouse(string $id): bool;
}
