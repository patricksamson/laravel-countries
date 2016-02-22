<?php

namespace Lykegenes\LaravelCountries\TestCase;

class CountriesTest extends \Orchestra\Testbench\TestCase
{
    /**
     * @var Lykegenes\LaravelCountries\Countries
     */
    protected $countries;

    public function setUp()
    {
        parent::setUp();

        $this->countries = $this->app->make(\Lykegenes\LaravelCountries\Countries::class);
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

    /** @test */
    public function it_gets_country_from_alpha2_code()
    {
        $country = $this->countries->getByAlpha2Code('CA');
        $this->assertEquals('Canada', $country['name']['official']);

        $country = $this->countries->getByAlpha2Code('ca');
        $this->assertEquals('Canada', $country['name']['official']);
    }

    /** @test */
    public function it_gets_country_from_alpha3_code()
    {
        $country = $this->countries->getByAlpha3Code('CAN');
        $this->assertEquals('Canada', $country['name']['official']);

        $country = $this->countries->getByAlpha3Code('can');
        $this->assertEquals('Canada', $country['name']['official']);
    }
    /** @test */
    public function it_gets_country_from_numeric_code()
    {
        $country = $this->countries->getByNumericCode(124);
        $this->assertEquals('Canada', $country['name']['official']);
    }
}
