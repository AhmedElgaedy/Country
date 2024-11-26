<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Services\CountryService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
         $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);

         $this->app->singleton(CountryService::class, function ($app) {
             return new CountryService();
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
