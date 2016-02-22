<?php

namespace Lykegenes\LaravelCountries\Tests;

class RegionsTest extends TestCase
{
    /** @test */
    public function regions_names_have_not_changed()
    {
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_AFRICA));
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_AMERICAS));
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_ASIA));
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_EUROPE));
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_OCEANIA)));
        $this->assertNotEmpty($this->countries->getByRegion(\Countries::$REGION_NONE));
    }
}
