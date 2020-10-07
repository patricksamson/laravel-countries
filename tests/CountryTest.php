<?php

namespace Lykegenes\LaravelCountries\Tests;

class CountryTest extends LaravelCountriesTestCase
{
    protected $country;

    public function setUp():void
    {
        parent::setUp();

        $this->country = $this->countries->getByAlpha2Code('CA');
    }

    /** @test */
    public function it_gets_alpha2_code()
    {
        $this->assertEquals('CA', $this->country->getAlpha2Code());
    }

    /** @test */
    public function it_gets_alpha3_code()
    {
        $this->assertEquals('CAN', $this->country->getAlpha3Code());
    }

    /** @test */
    public function it_gets_numeric_code()
    {
        $this->assertEquals(124, $this->country->getNumericCode());
    }

    /** @test */
    public function it_gets_official_name()
    {
        $this->assertEquals('Canada', $this->country->getOfficialName());
    }
}
