<?php

namespace Lykegenes\LaravelCountries;

class CountriesRepository
{
    use RegionsTrait, CountryAttributesTrait;

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

    public function getByAlpha2Code($code)
    {
        return $this->searchSingleItemByColumn(self::$ISO3166_ALPHA_2, strtoupper($code));
    }

    public function getByAlpha3Code($code)
    {
        return $this->searchSingleItemByColumn(self::$ISO3166_ALPHA_3, strtoupper($code));
    }

    public function getByNumericCode($code)
    {
        return $this->searchSingleItemByColumn(self::$ISO3166_NUMERIC_3, $code);
    }

    public function getByRegion($region)
    {
        return $this->searchMultipleItemsByColumn(self::$REGION, $region);
    }

    public function getBySubregion($subregion)
    {
        return $this->searchMultipleItemsByColumn(self::$SUBREGION, $subregion);
    }

    protected function searchSingleItemByColumn($columnKey, $input)
    {
        $key = array_search($input, array_column($this->data, $columnKey));

        return $this->data[$key];
    }

    protected function searchMultipleItemsByColumn($columnKey, $input)
    {
        $keys = array_flip(array_keys(array_column($this->data, $columnKey), $input));

        return array_intersect_key($this->data, $keys);
    }

    public function getRawData()
    {
        return $this->data;
    }
}
