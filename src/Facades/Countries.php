<?php

namespace Lykegenes\LaravelCountries\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @codeCoverageIgnore
 */
class Countries extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'countries';
    }
}
