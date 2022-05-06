<?php

namespace Lykegenes\LaravelCountries\Tests;

class LatestDataTest extends LaravelCountriesTestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-countries.countries_json_path', './tests/data/canada-only.json');
    }

    /** @test */
    public function it_loads_data_from_json()
    {
        $country = $this->countries->getByAlpha2Code('CA');
        $this->assertEquals('Canada', $country->getOfficialName());

        $this->assertNull($this->countries->getByAlpha2Code('JP'));
    }
}
