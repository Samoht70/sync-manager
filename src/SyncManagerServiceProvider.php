<?php

namespace Dailyapps\SyncManager;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SyncManagerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sync-manager.php',
            'sync-manager'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishing();

        $this->registerRoutes();

        $this->loadViewsFrom(
            __DIR__.'/../resources/views',
            'rest'
        );
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration(): array
    {
        return [
            'domain'     => config('rest.documentation.routing.domain'),
            'prefix'     => config('rest.documentation.routing.path'),
            'middleware' => config('rest.documentation.routing.middlewares', []),
        ];
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sync.php' => config_path('sync.php'),
            ], 'sync-config');
        }
    }

    /**
     * Register Sync's services in the container.
     *
     * @return void
     */
    protected function registerServices(): void
    {
        $this->app->singleton('sync-manager', SyncManager::class);
    }
}