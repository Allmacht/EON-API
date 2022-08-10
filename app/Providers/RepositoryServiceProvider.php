<?php

namespace App\Providers;

use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\ShippingServicePerWarehouseRepositoryInterface;
use App\Interfaces\ShippingServiceRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\WarehouseRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Repositories\ShippingServicePerWarehouseRepository;
use App\Repositories\ShippingServiceRepository;
use App\Repositories\UserRepository;
use App\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ShippingServiceRepositoryInterface::class, ShippingServiceRepository::class);
        $this->app->bind(ShippingServicePerWarehouseRepositoryInterface::class, ShippingServicePerWarehouseRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
