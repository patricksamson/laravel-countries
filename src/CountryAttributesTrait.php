<?php

namespace Lykegenes\LaravelCountries;

trait CountryAttributesTrait
{
    /**
     * The column constants.
     */
    protected static $ISO3166_ALPHA_2 = 'cca2';
    protected static $ISO3166_ALPHA_3 = 'cca3';
    protected static $ISO3166_NUMERIC_3 = 'ccn3';
    protected static $REGION = 'region';
    protected static $SUBREGION = 'subregion';
    protected static $CURRENCY = 'currency';
}
