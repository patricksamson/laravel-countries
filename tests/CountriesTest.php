<?php

namespace Lykegenes\LaravelCountries\Tests;

class CountriesTest extends LaravelCountriesTestCase
{
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

    /** @test */
    public function it_gets_countries_by_region()
    {
        $this->countries = $this->countries->getByRegion(\Countries::$REGION_AMERICAS);
        $codes = array_column($this->countries, 'cca2');

        $this->assertContains('CA', $codes);
        $this->assertNotContains('FR', $codes);
    }
}
