<?php

namespace Lykegenes\LaravelCountries;

use ArrayAccess;

class Country implements ArrayAccess
{
    protected $attributes = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get this country's 2-letters country code from ISO3166.
     *
     * @return string   The 2-letters country code
     */
    public function getAlpha2Code()
    {
        return $this->attributes['cca2'];
    }

    /**
     * Get this country's 3-letters country code from ISO3166.
     *
     * @return string   The 3-letters country code
     */
    public function getAlpha3Code()
    {
        return $this->attributes['cca3'];
    }

    /**
     * Get this country's 3-digits country code from ISO3166.
     *
     * @return int   The 3-digits country code
     */
    public function getNumericCode()
    {
        return $this->attributes['ccn3'];
    }

    /**
     * Get this country's official name.
     *
     * @return string   The country's official name
     */
    public function getOfficialName()
    {
        return $this->attributes['name']['official'];
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
}
