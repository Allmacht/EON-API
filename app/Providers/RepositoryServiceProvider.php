<?php

namespace App\Providers;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\WarehouseRepositoryInterface;
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