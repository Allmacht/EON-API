<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Resources\Client\ClientResource;
use App\Interfaces\ClientPerWarehouseRepositoryInterface;
use App\Interfaces\ClientRepositoryInterface;

class ClientController extends Controller
{
    private ClientRepositoryInterface $clientRepository;

    private ClientPerWarehouseRepositoryInterface $clientPerWarehouseRepository;

    public function __construct(
        ClientRepositoryInterface $clientRepository,
        ClientPerWarehouseRepositoryInterface $clientPerWarehouseRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->clientPerWarehouseRepository = $clientPerWarehouseRepository;
    }

    public function store(StoreRequest $request): ClientResource
    {
        $client = $this->clientRepository->store($request->safe()->toArray());
        $this->clientPerWarehouseRepository->setWarehousesToClient($client->id, $request->safe()->warehouses);

        return new ClientResource($client->load('warehouses'));
    }
}
