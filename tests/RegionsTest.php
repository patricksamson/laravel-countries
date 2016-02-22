<?php

namespace Lykegenes\LaravelCountries\Tests;

class RegionsTest extends LaravelCountriesTestCase
{
    /** @test */
    public function it_makes_sure_regions_names_have_not_changed()
    {
        $africa = $this->countries->getByRegion(\Countries::$REGION_AFRICA);
        $americas = $this->countries->getByRegion(\Countries::$REGION_AMERICAS);
        $asia = $this->countries->getByRegion(\Countries::$REGION_ASIA);
        $europe = $this->countries->getByRegion(\Countries::$REGION_EUROPE);
        $oceania = $this->countries->getByRegion(\Countries::$REGION_OCEANIA);
        $others = $this->countries->getByRegion(\Countries::$REGION_NONE);

        $this->assertNotEmpty($africa);
        $this->assertNotEmpty($americas);
        $this->assertNotEmpty($asia);
        $this->assertNotEmpty($europe);
        $this->assertNotEmpty($oceania);
        $this->assertNotEmpty($others);

        $this->assertEquals(count($this->countries->getRawData()),
            count($africa) + count($americas) + count($asia) + count($europe) + count($oceania) + count($others));
    }
}
