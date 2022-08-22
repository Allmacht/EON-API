<?php

namespace App\Repositories;

use App\Interfaces\ClientPerWarehouseRepositoryInterface;
use App\Models\ClientsPerWarehouse;
use Illuminate\Support\Collection;

class ClientPerWarehouseRepository implements ClientPerWarehouseRepositoryInterface
{
    public function setWarehousesToClient(string $client_id, array $warehouses): Collection
    {
        return collect($warehouses)->map(function ($warehouse) use ($client_id) {
            return ClientsPerWarehouse::create([
                'client_id' => $client_id,
                'warehouse_id' => $warehouse,
            ]);
        });
    }
}
