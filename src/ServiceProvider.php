<?php

namespace Lykegenes\LaravelCountries;

/**
 * @codeCoverageIgnore
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('countries', \Lykegenes\LaravelCountries\CountriesRepository::class);
    }

    public function boot()
    {
        // no config to publish.
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return ['countries'];
    }
}
