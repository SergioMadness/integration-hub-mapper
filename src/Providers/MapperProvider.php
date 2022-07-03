<?php namespace professionalweb\IntegrationHub\Mapper\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Mapper\Models\MapperOptions;
use professionalweb\IntegrationHub\Mapper\Services\MapperService;
use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\SubsystemPool;

class MapperProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'IntegrationHubMapper');

        $this->app->booted(static function () {
            /** @var SubsystemPool $pool */
            $pool = app(SubsystemPool::class);
            $pool->register(trans('IntegrationHubMapper::common.name'), MapperService::SUBSYSTEM_ID, new MapperOptions());
        });
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->singleton(MapperSubsystem::class, MapperService::class);
    }
}