<?php

namespace Lykegenes\LaravelCountries\Tests;

abstract class LaravelCountriesTestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @var Lykegenes\LaravelCountries\CountriesRepository
     */
    protected $countries;

    public function setUp():void
    {
        parent::setUp();

        $this->countries = $this->app->make('countries');
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Lykegenes\LaravelCountries\ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Countries' => \Lykegenes\LaravelCountries\Facades\Countries::class,
        ];
    }
}
