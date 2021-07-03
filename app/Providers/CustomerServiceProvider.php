<?php

namespace App\Providers;

use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\CustomerServiceInterface;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CustomerRepositoryInterface::class,CustomerRepository::class);
        $this->app->bind(CustomerServiceInterface::class,CustomerService::class);

    }
}
