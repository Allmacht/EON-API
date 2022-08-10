<?php

namespace App\Interfaces;

interface ShippingServicePerWarehouseRepositoryInterface
{
    public function getShippingServicesPerWarehouse(string $id);
}
