<?php

namespace Lykegenes\LaravelCountries;

class Country
{
    use CountryAttributesTrait;

    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getAlpha2Code()
    {
        return $this->data[self::$ISO3166_ALPHA_2];
    }

    public function getAlpha2Code()
    {
        return $this->data[self::$ISO3166_ALPHA_3];
    }

    public function getNumericCode()
    {
        return $this->data[self::$$ISO3166_NUMERIC_3];
    }

    public function getRawData()
    {
        return $this->data;
    }

    public function __get($name)
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
}
