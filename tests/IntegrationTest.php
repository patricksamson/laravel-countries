<?php

namespace Lykegenes\LaravelCountries\Tests;

class IntegrationTest extends TestCase
{
    /** @test */
    public function it_resolves_from_container()
    {
        $countries = $this->app['countries'];
        $country = $countries->getByAlpha2Code('CA');
        $this->assertEquals('Canada', $country['name']['official']);
    }

    /** @test */
    public function it_resolves_from_facade()
    {
        $country = \Countries::getByAlpha2Code('CA');
        $this->assertEquals('Canada', $country['name']['official']);
    }
}
