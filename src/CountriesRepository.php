<?php

namespace Lykegenes\LaravelCountries;

class CountriesRepository
{
    use RegionsTrait;

    /**
     * Dependencies paths.
     */
    protected static $PROD_PATH = __DIR__.'/../../../mledoze/countries/dist/countries-unescaped.json';
    protected static $DEV_PATH = __DIR__.'/../vendor/mledoze/countries/dist/countries-unescaped.json';

    protected $data = [];

    public function __construct()
    {
        if (file_exists(self::$PROD_PATH)) {
            $this->data = json_decode(file_get_contents(self::$PROD_PATH), true);
        } elseif (file_exists(self::$DEV_PATH)) {
            $this->data = json_decode(file_get_contents(self::$DEV_PATH), true);
        } else {
            throw new Exception(sprintf('Cannot find the file "%s".', self::$PROD_PATH));
        }
    }

    /**
     * Get the country from it's 2-letters country code from ISO3166.
     *
     * @param  string $code The country's code.
     * @return Country   The matching country.
     */
    public function getByAlpha2Code($code)
    {
        return $this->searchItem('cca2', strtoupper($code));
    }

    /**
     * Get the country from it's 3-letters country code from ISO3166.
     *
     * @param  string $code The country's code.
     * @return Country   The matching country.
     */
    public function getByAlpha3Code($code)
    {
        return $this->searchItem('cca3', strtoupper($code));
    }

    /**
     * Get the country from it's 3-digits country code from ISO3166.
     *
     * @param  int $code The country's code.
     * @return Country   The matching country.
     */
    public function getByNumericCode($code)
    {
        return $this->searchItem('ccn3', $code);
    }

    /**
     * Get all the countries in a region.
     *
     * @param  string $region The region name
     * @return array   An array of the matching countries.
     */
    public function getByRegion($region)
    {
        return $this->searchArray('region', $region);
    }

    /**
     * Get all the countries in a subregion.
     *
     * @param  string $region The subregion name
     * @return array   An array of the matching countries.
     */
    public function getBySubregion($subregion)
    {
        return $this->searchArray('subregion', $subregion);
    }

    /**
     * Get all the countries using this currency.
     *
     * @param  string $region The currency code
     * @return array   An array of the matching countries.
     */
    public function getByCurrency($currency)
    {
        $results = array_filter($this->data, function ($value) use ($currency) {
            return in_array($currency, $value['currency']);
        });

        $countries = [];

        foreach ($results as $value) {
            $countries[] = new Country($value);
        }

        return $countries;
    }

    /**
     * Get a single Country by filtering this column.
     *
     * @param  string $columnKey The column to filter
     * @param  mixed $input     The value to filter for
     * @return Lykegenes\LaravelCountries\Country|null  The matching country or null
     */
    protected function searchItem($columnKey, $input)
    {
        // Only the first matching key will be returned, or null.
        $key = array_search($input, array_column($this->data, $columnKey));

        return new Country($this->data[$key]);
    }

    /**
     * Get an array of Countries by filtering this column.
     *
     * @param  string $columnKey The column to filter
     * @param  mixed $input     The value to filter for
     * @return Lykegenes\LaravelCountries\Country|null  The matching country or null
     */
    protected function searchArray($columnKey, $input)
    {
        // Apply filter on the dataset.
        $keys = array_keys(array_column($this->data, $columnKey), $input);

        // Flip the keys and values to get the original keys from the dataset.
        $keys = array_flip($keys);

        // Extract the matching keys and associated data from the dataset.
        $keys = array_intersect_key($this->data, $keys);

        $countries = [];
        foreach ($keys as $value) {
            $countries[] = new Country($value);
        }

        return $countries;
    }

    public function getRawData()
    {
        return $this->data;
    }
}
