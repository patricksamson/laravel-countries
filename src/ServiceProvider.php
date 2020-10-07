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
        $this->mergeConfigFrom(
            __DIR__.'/config/laravel-countries.php', 'laravel-countries'
        );

        $this->app->singleton('countries', \Lykegenes\LaravelCountries\CountriesRepository::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/laravel-countries.php' => config_path('laravel-countries.php'),
        ]);
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return ['countries'];
    }
}
