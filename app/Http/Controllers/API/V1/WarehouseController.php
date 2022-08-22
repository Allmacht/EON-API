<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\CreateRequest;
use App\Http\Requests\Warehouse\DeleteRequest;
use App\Http\Requests\Warehouse\GetWarehouseRequest;
use App\Http\Requests\Warehouse\GetWarehousesRequest;
use App\Http\Requests\Warehouse\UpdateRequest;
use App\Http\Resources\Warehouse\WarehouseCollection;
use App\Http\Resources\Warehouse\WarehouseResource;
use App\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     ** all warehouse records are obtained.
     *
     * @param  App\Http\Requests\Warehouse\GetWarehouseRequest  $request
     * @return App\Http\Resources\Warehouse\WarehouseCollection
     */
    public function index(GetWarehousesRequest $request): WarehouseCollection
    {
        $warehouses = $this->warehouseRepository->getWarehouses();

        return new WarehouseCollection($warehouses);
    }

    /**
     ** the warehouses to which the user making the request has access are obtained.
     *
     * @param  Illuminate\Http\Request  $request
     * @return App\Http\Resources\Warehouse\WarehouseCollection
     */
    public function myWarehouses(Request $request): WarehouseCollection
    {
        $warehouses = $this->warehouseRepository->getMyWarehouses($request->user()->id);

        return new WarehouseCollection($warehouses);
    }

    /**
     ** the record of a specific warehouse is obtained.
     *
     * @param  App\Http\Requests\Warehouse\GetWarehouseRequest  $request
     * @return App\Http\Resources\Warehouse\WarehouseResource
     */
    public function warehouse(GetWarehouseRequest $request): WarehouseResource
    {
        $warehouse = $this->warehouseRepository->getWarehouseById($request->safe()->warehouse);

        return new WarehouseResource($warehouse);
    }

    /**
     ** A new warehouse is stored.
     *
     * @param  App\Http\Requests\Warehouse\CreateRequest  $request
     * @return App\Http\Resources\Warehouse\WarehouseResource
     */
    public function store(CreateRequest $request): WarehouseResource
    {
        $warehouse = $this->warehouseRepository->storeWarehouse($request->safe()->toArray());

        return new WarehouseResource($warehouse);
    }

    /**
     ** update warehouse information.
     *
     * @param  App\Http\Requests\Warehouse\UpdateRequest  $request
     * @return App\Http\Resources\Warehouse\WarehouseResource
     */
    public function update(UpdateRequest $request): WarehouseResource
    {
        $this->warehouseRepository->updateWarehouse($request->safe()->warehouse, $request->safe()->except('warehouse', 'created_at', 'updated_at'));

        $warehouse = $this->warehouseRepository->getWarehouseById($request->safe()->warehouse);

        return new WarehouseResource($warehouse);
    }

    /**
     ** Delete a specific warehouse
     *
     * @param  App\Http\Requests\Warehouse\DeleteRequest  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function delete(DeleteRequest $request): JsonResponse
    {
        $this->warehouseRepository->deleteWarehouse($request->safe()->warehouse);

        return response()->json(['status' => 200, 'success' => true, 'message' => 'warehouse removed successfully.'], 200);
    }
}
