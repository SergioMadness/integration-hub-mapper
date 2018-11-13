<?php namespace professionalweb\IntegrationHub\Mapper\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Mapper\Services\MapperService;
use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;
use professionalweb\IntegrationHub\Mapper\Listeners\NewRequestListener;

class MapperProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(NewRequestListener::class);
    }

    public function boot(): void
    {
        $this->app->singleton(MapperSubsystem::class, MapperService::class);
    }
}