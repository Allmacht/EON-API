<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\GetWarehouseRequest;
use App\Http\Requests\Warehouse\GetWarehousesRequest;
use App\Http\Resources\Warehouse\WarehouseCollection;
use App\Http\Resources\Warehouse\WarehouseResource;
use App\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function index(GetWarehousesRequest $request): WarehouseCollection
    {
        $warehouses = $this->warehouseRepository->getWarehouses();

        return new WarehouseCollection($warehouses);
    }

    public function myWarehouses(Request $request): WarehouseCollection
    {
        $warehouses = $this->warehouseRepository->getMyWarehouses($request->user()->id);

        return new WarehouseCollection($warehouses);
    }

    public function warehouse(GetWarehouseRequest $request): WarehouseResource
    {
        $warehouse = $this->warehouseRepository->getWarehouseById($request->safe()->warehouse);

        return new WarehouseResource($warehouse);
    }
}
