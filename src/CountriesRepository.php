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

        return $this->castArrayToCountries($results);
    }

    /**
     * Get a dropdown-ready list of countries.
     *
     * @param  string  $key          The country attribute to use as key.
     * @param  bool $official     True for the offical country name, False for the common name.
     * @param  string  $localization A 3-letter locale code to try to translate. Will default to English if it`s missing.
     * @return array                 An array composed of the selected Keys, and the Countries names as values.
     */
    public function getListForDropdown($key = 'cca3', $official = false, $localization = null)
    {
        $list = [];

        $size = count($this->data);
        for ($i = 0; $i < $size; $i++) {
            // Try to get the translated names, if they are present
            $names = ($localization === null || ! isset($this->data[$i]['translations'][$localization]))
                    ? $this->data[$i]['name']
                    : $this->data[$i]['translations'][$localization];

            // Set this country in the list to either it's Official or common name
            $list[$this->data[$i][$key]] = $official ? $names['official'] : $names['common'];
        }

        return $list;
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

        return $this->castArrayToCountries($keys);
    }

    public function getRawData()
    {
        return $this->data;
    }

    protected function castArrayToCountries(array $inputArray)
    {
        $countries = [];
        foreach ($inputArray as $value) {
            $country = new Country($value);
            $countries[$country->getAlpha2Code()] = $country;
        }

        return $countries;
    }

    /**
     * Get an array of all countries with the format provided by parameter.
     *
     * @param  string $format The format to receive the value for the select.
     * @param  string $language The language you want the data to be received (3 letter code).
     * @param  string $common OPTIONAL The common name (value="common") or the official name (value="official").
     * @return array   An array of the countries with their format as the option value for your select
     */
    public function getCountriesArrayForSelect($format, $language, $common = "common")
    {
        $countries = [];
        foreach ($this->getRawData() as $country) {
            $countries[$country[$format]] = $country['translations'][$language][$common];
        }
        return $countries;
    }
}
