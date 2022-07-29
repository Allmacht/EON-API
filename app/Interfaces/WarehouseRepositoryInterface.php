<?php

namespace App\Interfaces;

interface WarehouseRepositoryInterface
{
    public function getWarehouses();

    public function getMyWarehouses(string $id);

    public function getWarehouseById(string $id);

    public function storeWarehouse(array $params);

    public function updateWarehouse(string $id, array $params);

    public function deleteWarehouse(string $id);
}
