<?php

namespace App\Providers;

use App\Models\Region;
use App\Models\Street;
use App\Repositories\RegionRepository;
use App\Repositories\StreetRepository;
use App\Services\StreetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(RegionRepository::class, function ($app) {
            return new RegionRepository($app->make(Region::class));
        });
        $this->app->bind(StreetRepository::class, function ($app) {
            return new StreetRepository($app->make(Street::class));
        });

        $this->app->bind(StreetService::class, function ($app) {
            return new StreetService($app->make(StreetRepository::class), $app->make(RegionRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
