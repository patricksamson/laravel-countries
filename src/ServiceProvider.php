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
        $configPath = __DIR__.'/../config/config.php';
        $this->mergeConfigFrom($configPath, 'countries');

        $this->app->singleton('countries', \Lykegenes\LaravelCountries\CountriesRepository::class);
    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/config.php';

        $this->publishes([$configPath => $this->getConfigPath()], 'config');
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return ['countries'];
    }

    /**
     * Get the config path.
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return config_path('countries.php');
    }
}
