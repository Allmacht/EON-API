<?php

namespace App\Interfaces;

use App\Models\ShippingService;
use Illuminate\Database\Eloquent\Collection;

interface ShippingServiceRepositoryInterface
{
    public function getAllShippingServices(): Collection;

    public function getShippingServiceById(string $id): ?ShippingService;

    public function storeShippingService(array $params): ShippingService;

    public function updateShippingService(string $id, array $params): bool;

    public function deleteShippingService(string $id): bool;
}
