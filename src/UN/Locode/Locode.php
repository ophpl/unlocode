<?php

namespace UN\Locode;

use UN\Locode\Model;
use UN\Locode\Reader\ReaderInterface;

/**
 * Class Locode
 * @package UN\Locode
 * @description Locode API
 */
class Locode {

    /**
     * @var string $path path to data folder
     */
    private $path;

    /**
     * @var ReaderInterface $reader data reader
     */
    private $reader;

    /**
     * @param $path
     * @param ReaderInterface $reader
     */
    public function __construct($path, ReaderInterface $reader)
    {
        $this->path = $path;
        $this->reader = $reader;
    }

    /**
     * Get list by country
     *
     * @param string $country ISO 3166-1 country code
     * @return array<Model\Locode>
     */
    public function getListByCountry($country)
    {
        $country = strtolower($country);

        $list = $this->reader->read($this->path, $country);

        foreach($list as $key => $entry) {
            $list[$key] = new Model\Locode($entry);
        }

        return $list;
    }

    /**
     * Get by country and city name
     *
     * @param string $country ISO 3166-1 country code
     * @param string $name city name
     * @return null|Model\Locode
     */
    public function getByCountryAndName($country, $name)
    {
        $country = strtolower($country);

        $entry = $this->reader->findEntry($this->path, $country, 'name', $name);

        if (null === $entry) {
            return null;
        }

        return new Model\Locode($entry);
    }

    /**
     * Get by country and locode
     *
     * @param string $country ISO 3166-1 country code
     * @param string $code UN locode
     * @return null|Model\Locode
     */
    public function getByCountryAndCode($country, $code)
    {
        $country = strtolower($country);

        $entry = $this->reader->findEntry($this->path, $country, 'locode', $code);

        if (null === $entry) {
            return null;
        }

        return new Model\Locode($entry);
    }

}