<?php

namespace App\Repositories;

use App\Interfaces\ShippingServiceRepositoryInterface;
use App\Models\ShippingService;
use Illuminate\Database\Eloquent\Collection;

class ShippingServiceRepository implements ShippingServiceRepositoryInterface
{
    public function getAllShippingServices(): Collection
    {
        return ShippingService::all();
    }

    public function getShippingServiceById(string $id): ShippingService
    {
        return ShippingService::whereKey($id)->sole();
    }

    public function storeShippingService(array $params): ShippingService
    {
        return ShippingService::create($params);
    }

    public function updateShippingService(string $id, array $params): bool
    {
        return ShippingService::whereKey($id)->update($params);
    }

    public function deleteShippingService(string $id): bool
    {
        return ShippingService::whereKey($id)->delete();
    }
}
