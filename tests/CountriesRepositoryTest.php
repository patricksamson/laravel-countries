<?php

namespace Lykegenes\LaravelCountries\Tests;

class CountriesRepositoryTest extends LaravelCountriesTestCase
{
    /** @test */
    public function it_gets_country_from_alpha2_code()
    {
        $country = $this->countries->getByAlpha2Code('CA');
        $this->assertEquals('Canada', $country->getOfficialName());

        $country = $this->countries->getByAlpha2Code('ca');
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_country_from_alpha3_code()
    {
        $country = $this->countries->getByAlpha3Code('CAN');
        $this->assertEquals('Canada', $country->getOfficialName());

        $country = $this->countries->getByAlpha3Code('can');
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_country_from_numeric_code()
    {
        $country = $this->countries->getByNumericCode(124);
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_countries_by_region()
    {
        $results = $this->countries->getByRegion(\Countries::$REGION_AMERICAS);
        $codes = array_column($results, 'cca2');

        $this->assertContains('CA', $codes);
        $this->assertNotContains('FR', $codes);
    }

    /** @test */
    public function it_gets_countries_by_subregion()
    {
        $results = $this->countries->getBySubregion('Northern America');
        $codes = array_column($results, 'cca2');

        $this->assertContains('CA', $codes);
        $this->assertNotContains('FR', $codes);
    }
    /** @test */
    public function it_gets_countries_by_currency()
    {
        $results = $this->countries->getByCurrency('CAD');
        $codes = array_column($results, 'cca2');

        $this->assertContains('CA', $codes);
        $this->assertNotContains('FR', $codes);
    }
}
