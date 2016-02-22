<?php

namespace Lykegenes\LaravelCountries\Facades;

use Illuminate\Support\Facades\Facade;
use Lykegenes\LaravelCountries\RegionsTrait;

/**
 * @codeCoverageIgnore
 */
class Countries extends Facade
{
    use RegionsTrait;

    public static function getFacadeAccessor()
    {
        return 'countries';
    }
}
