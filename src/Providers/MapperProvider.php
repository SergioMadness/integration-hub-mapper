<?php namespace professionalweb\IntegrationHub\Mapper\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Mapper\Services\MapperService;
use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;

class MapperProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->singleton(MapperSubsystem::class, MapperService::class);
    }
}