<?php

namespace Lykegenes\LaravelCountries\Tests;

class CountriesRepositoryTest extends LaravelCountriesTestCase
{
    /** @test */
    public function it_gets_country_from_alpha2_code()
    {
        $country = $this->countries->getByAlpha2Code('CA');
        $this->assertInstanceOf(\Lykegenes\LaravelCountries\Country::class, $country);
        $this->assertEquals('Canada', $country->getOfficialName());

        $country = $this->countries->getByAlpha2Code('ca');
        $this->assertInstanceOf(\Lykegenes\LaravelCountries\Country::class, $country);
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_country_from_alpha3_code()
    {
        $country = $this->countries->getByAlpha3Code('CAN');
        $this->assertInstanceOf(\Lykegenes\LaravelCountries\Country::class, $country);
        $this->assertEquals('Canada', $country->getOfficialName());

        $country = $this->countries->getByAlpha3Code('can');
        $this->assertInstanceOf(\Lykegenes\LaravelCountries\Country::class, $country);
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_country_from_numeric_code()
    {
        $country = $this->countries->getByNumericCode(124);

        $this->assertInstanceOf(\Lykegenes\LaravelCountries\Country::class, $country);
        $this->assertEquals('Canada', $country->getOfficialName());
    }

    /** @test */
    public function it_gets_countries_by_region()
    {
        $results = $this->countries->getByRegion(\Countries::$REGION_AMERICAS);
        $codes = array_column($results, 'cca2');

        $this->assertContainsOnlyInstancesOf(\Lykegenes\LaravelCountries\Country::class, $results);
        $this->assertArrayHasKey('CA', $results);
        $this->assertArrayNotHasKey('FR', $results);
    }

    /** @test */
    public function it_gets_countries_by_subregion()
    {
        $results = $this->countries->getBySubregion('Northern America');
        $codes = array_column($results, 'cca2');

        $this->assertContainsOnlyInstancesOf(\Lykegenes\LaravelCountries\Country::class, $results);
        $this->assertArrayHasKey('CA', $results);
        $this->assertArrayNotHasKey('FR', $results);
    }
    /** @test */
    public function it_gets_countries_by_currency()
    {
        $results = $this->countries->getByCurrency('CAD');

        $this->assertContainsOnlyInstancesOf(\Lykegenes\LaravelCountries\Country::class, $results);
        $this->assertArrayHasKey('CA', $results);
        $this->assertArrayNotHasKey('FR', $results);
    }
}
