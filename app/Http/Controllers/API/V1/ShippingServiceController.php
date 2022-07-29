<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingService\GetShippingServiceRequest;
use App\Http\Requests\ShippingService\StoreRequest;
use App\Http\Resources\ShippingService\ShippingServiceResource;
use App\Interfaces\ShippingServiceRepositoryInterface;

class ShippingServiceController extends Controller
{
    private ShippingServiceRepositoryInterface $shippingServiceRepository;

    public function __construct(ShippingServiceRepositoryInterface $shippingServiceRepository)
    {
        $this->shippingServiceRepository = $shippingServiceRepository;
    }

    /**
     * the information of a specific shipping service is returned
     *
     * @param  App\Http\Requests\ShippingService\GetShippingServiceRequest  $request
     * @return App\Http\Resources\ShippingService\ShippingServiceResource
     */
    public function shipping_service(GetShippingServiceRequest $request): ShippingServiceResource
    {
        $shippingService = $this->shippingServiceRepository->getShippingServiceById($request->safe()->shipping_service);

        return new ShippingServiceResource($shippingService);
    }

    /**
     * The information of a new shipping service is stored
     *
     * @param  App\Http\Requests\ShippingService\StoreRequest  $request
     * @return App\Http\Resources\ShippingService\ShippingServiceResource
     */
    public function store(StoreRequest $request): ShippingServiceResource
    {
        $data = $request->safe()->all();

        if ($request->file('image')) {
            $path = $request->file('image')->store('shipping_services');
            $data['image'] = $path;
        }

        $shippingService = $this->shippingServiceRepository->storeShippingService($data);

        return new ShippingServiceResource($shippingService);
    }
}
