<?php

namespace App\Interfaces;

interface ShippingServiceRepositoryInterface
{
    public function getAllShippingServices();

    public function getShippingServiceById(string $id);

    public function storeShippingService(array $params);

    public function updateShippingService(string $id, array $params);

    public function deleteShippingService(string $id);
}
