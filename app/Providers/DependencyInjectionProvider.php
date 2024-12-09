<?php

namespace App\Providers;

use App\Repositories\DiseaseCertaintyRepository;
use App\Services\DiseaseCertaintyService;
use App\Services\LandingService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class DependencyInjectionProvider extends ServiceProvider
{
    public $bindings = [
        DiseaseCertaintyRepository::class => DiseaseCertaintyRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DiseaseCertaintyService::class, function (Application $app) {
            return new DiseaseCertaintyService($app->make(DiseaseCertaintyRepository::class));
        });
        $this->app->singleton(LandingService::class, function (Application $app) {
            return new LandingService($app->make(DiseaseCertaintyRepository::class));
        });
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
