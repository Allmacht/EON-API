<?php

namespace App\Repositories;

use App\Interfaces\ShippingServicePerWarehouseRepositoryInterface;
use App\Models\ShippingServicesPerWarehouse;

class ShippingServicePerWarehouseRepository implements ShippingServicePerWarehouseRepositoryInterface
{
    public function getShippingServicesPerWarehouse(string $id)
    {
        return ShippingServicesPerWarehouse::whereWarehouseId($id)->get();
    }
}
