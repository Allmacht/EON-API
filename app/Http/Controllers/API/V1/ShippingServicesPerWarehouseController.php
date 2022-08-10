<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Interfaces\ShippingServicePerWarehouseRepositoryInterface;

class ShippingServicesPerWarehouseController extends Controller
{
    private ShippingServicePerWarehouseRepositoryInterface $ShippingServicePerWarehouseRepository;

    public function __construct(ShippingServicePerWarehouseRepositoryInterface $ShippingServicePerWarehouseRepository)
    {
        $this->$ShippingServicePerWarehouseRepository = $ShippingServicePerWarehouseRepository;
    }
}
