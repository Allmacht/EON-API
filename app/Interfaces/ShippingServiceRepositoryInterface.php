<?php

namespace App\Interfaces;

interface ShippingServiceRepositoryInterface
{
    public function getShippingServiceById(string $id);

    public function storeShippingService(array $params);
}
