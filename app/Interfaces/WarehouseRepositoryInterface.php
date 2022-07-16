<?php

namespace App\Interfaces;

interface WarehouseRepositoryInterface
{
    public function getWarehouses();

    public function getMyWarehouses(string $id);

    public function getWarehouseById(string $id);

    public function createWarehouse(array $params);

    public function updateWarehouse(string $id, array $params);
}
