<?php

namespace AlwaysOpen\OxylabsApi;

use Illuminate\Support\ServiceProvider;

class OxylabsApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OxylabsApiClient::class, function ($app) {
            return new OxylabsApiClient(
                config('oxylabs-api.base_url'),
                config('oxylabs-api.username'),
                config('oxylabs-api.password'),
                config('oxylabs-api.auth_method', 'basic')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/oxylabs-api.php' => config_path('oxylabs-api.php'),
            __DIR__.'/../config/data.php' => config_path('data.php'),
        ], 'config');
    }
}
