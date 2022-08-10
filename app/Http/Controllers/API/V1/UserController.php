<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateWarehouseRequest;
use App\Http\Resources\User\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * return the logged in user.
     *
     * @param  Illuminate\Http\Request  $request
     * @return App\Http\Resources\User\UserResource
     */
    public function user(Request $request): UserResource
    {
        $user = $this->userRepository->me($request->user()->id);

        return new UserResource($user);
    }

    /**
     * update the user's current warehouse.
     *
     * @param  App\Http\Requests\User\UpdateWarehouseRequest  $request
     * @return App\Http\Resources\User\UserResource
     */
    public function updateWarehouse(UpdateWarehouseRequest $request): UserResource
    {
        $this->userRepository->update($request->user()->id, $request->safe()->only('warehouse_id'));

        $user = $this->userRepository->me($request->user()->id);

        return new UserResource($user);
    }
}
