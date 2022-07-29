<?php

namespace App\Repositories;

use App\Interfaces\ShippingServiceRepositoryInterface;
use App\Models\ShippingService;

class ShippingServiceRepository implements ShippingServiceRepositoryInterface
{
    public function getShippingServiceById(string $id): ShippingService
    {
        return ShippingService::whereKey($id)->sole();
    }

    public function storeShippingService(array $params): ShippingService
    {
        return ShippingService::create($params);
    }
}
