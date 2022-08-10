<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingService\DeleteRequest;
use App\Http\Requests\ShippingService\GetShippingServiceRequest;
use App\Http\Requests\ShippingService\GetShippingServicesRequest;
use App\Http\Requests\ShippingService\StoreRequest;
use App\Http\Requests\ShippingService\UpdateRequest;
use App\Http\Resources\ShippingService\ShippingServiceCollection;
use App\Http\Resources\ShippingService\ShippingServiceResource;
use App\Interfaces\ShippingServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ShippingServiceController extends Controller
{
    private ShippingServiceRepositoryInterface $shippingServiceRepository;

    public function __construct(ShippingServiceRepositoryInterface $shippingServiceRepository)
    {
        $this->shippingServiceRepository = $shippingServiceRepository;
    }

    /**
     ** All shipping services are returned
     *
     * @param  App\Http\Requests\ShippingService\GetShippingServicesRequest  $request
     * @return App\Http\Resources\ShippingService\ShippingServiceCollection
     */
    public function index(GetShippingServicesRequest $request): ShippingServiceCollection
    {
        $shipping_services = $this->shippingServiceRepository->getAllShippingServices();

        return new ShippingServiceCollection($shipping_services);
    }

    /**
     ** the information of a specific shipping service is returned
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
     ** The information of a new shipping service is stored
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

    /**
     ** The information of a specific shipping service is updated
     *
     * @param  App\Http\Requests\ShippingService\UpdateRequest  $request
     * @return App\Http\Resources\ShippingService\ShippingServiceResource
     */
    public function update(UpdateRequest $request): ShippingServiceResource
    {
        $data = $request->safe()->except('id', 'created_at');

        $shippingService = $this->shippingServiceRepository->getShippingServiceById($request->safe()->id);

        if ($request->file('image')) {
            $shippingService->image ? Storage::delete($shippingService->image) : null;
            $path = $request->file('image')->store('shipping_services');
            $data['image'] = $path;
        } else {
            $data['image'] = $shippingService->image;
        }

        $this->shippingServiceRepository->updateShippingService($request->safe()->id, $data);

        return new ShippingServiceResource($shippingService->refresh());
    }

    /**
     ** A specific shipping service is deleted
     *
     * @param  App\Http\Requests\ShippingService\DeleteRequest  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function delete(DeleteRequest $request): JsonResponse
    {
        $shippingService = $this->shippingServiceRepository->getShippingServiceById($request->safe()->id);
        $shippingService->image ? Storage::delete($shippingService->image) : null;

        $this->shippingServiceRepository->deleteShippingService($request->safe()->id);

        return response()->json(['success' => true, 'message' => 'Shipping service removed successfully']);
    }
}
