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

    public function getByAlpha2Code($code)
    {
        return $this->getItemWhere('cca2', strtoupper($code));
    }

    public function getByAlpha3Code($code)
    {
        return $this->getItemWhere('cca3', strtoupper($code));
    }

    public function getByNumericCode($code)
    {
        return $this->getItemWhere('ccn3', $code);
    }

    public function getByRegion($region)
    {
        return $this->getListWhere('region', $region);
    }

    public function getBySubregion($subregion)
    {
        return $this->getListWhere('subregion', $subregion);
    }

    public function getByCurrency($currency)
    {
        return $this->getListWhere('currency', $currency);
    }

    /**
     * Get a single Country by filtering this column.
     * @param  string $columnKey The column to filter
     * @param  mixed $input     The value to filter for
     * @return Lykegenes\LaravelCountries\Country|null            The matching country or null
     */
    protected function getItemWhere($columnKey, $input)
    {
        $key = array_search($input, array_column($this->data, $columnKey));

        return new Country($this->data[$key]);
    }

    protected function getListWhere($columnKey, $input)
    {
        $keys = array_flip(array_keys(array_column($this->data, $columnKey), $input));
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
