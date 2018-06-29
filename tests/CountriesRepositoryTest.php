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
        $results = $this->countries->getBySubregion('North America');
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

    /** @test */
    public function it_returns_list_form_dropdown()
    {
        // Test the key parameter
        $results = $this->countries->getListForDropdown('cca2');
        $this->assertArrayHasKey('US', $results);

        $results = $this->countries->getListForDropdown('cca3');
        $this->assertArrayHasKey('USA', $results);

        // Test the Official parameter
        $results = $this->countries->getListForDropdown('cca3', $official = false);
        $this->assertEquals('United States', $results['USA']);

        $results = $this->countries->getListForDropdown('cca3', $official = true);
        $this->assertEquals('United States of America', $results['USA']);

        // Test the Localization parameter
        $results = $this->countries->getListForDropdown('cca3', $official = false, null);
        $this->assertEquals('United States', $results['USA']);

        $results = $this->countries->getListForDropdown('cca3', $official = false, 'fra');
        $this->assertEquals('États-Unis', $results['USA']);

        $results = $this->countries->getListForDropdown('cca3', $official = true, 'fra');
        $this->assertEquals("Les états-unis d'Amérique", $results['USA']);
    }
}
