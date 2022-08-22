<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ClientPerWarehouseRepositoryInterface
{
    public function setWarehousesToClient(string $client_id, array $warehouses): Collection;
}
