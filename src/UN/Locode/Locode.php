<?php

namespace UN\Locode;

use UN\Locode\Model\Location;
use UN\Locode\Reader\ReaderInterface;
use UN\Locode\Reader\YamlReader;

/**
 * Class Locode
 * @package UN\Locode
 * @description Locode API
 */
class Locode
{

    /**
     * @var string $path path to data folder
     */
    private $path;

    /**
     * @var ReaderInterface $reader data reader
     */
    private $reader;

    /**
     * @param string $path path to data folder
     * @param ReaderInterface $reader data reader, by default yaml reader
     */
    public function __construct($path = null, ReaderInterface $reader = null)
    {
        if (null === $path) {
            $path = __DIR__."/../../../data";
        }

        if (null === $reader) {
            $reader = new YamlReader();
        }

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
        $list = $this->reader->read($this->path, $country);

        foreach($list as $key => $entry) {
            $list[$key] = new Location($entry);
        }

        return $list;
    }

    /**
     * Get by country and city name
     *
     * @param string $country ISO 3166-1 country code
     * @param string $name city name
     * @return null|Location
     */
    public function getByCountryAndName($country, $name)
    {
        $entry = $this->reader->findEntry($this->path, $country, 'name', $name);

        if (null === $entry) {
            return null;
        }

        return new Location($entry);
    }

    /**
     * Get by country and code
     *
     * @param string $country ISO 3166-1 country code
     * @param string $code city code
     * @return null|Location
     */
    public function getByCountryAndCode($country, $code)
    {
        $entry = $this->reader->findEntry($this->path, $country, 'locode', strtoupper($country.' '.$code));

        if (null === $entry) {
            return null;
        }

        return new Location($entry);
    }

    /**
     * Get by locode
     *
     * @param string $locode UN locode
     * @throws \InvalidArgumentException
     * @return null|Location
     */
    public function getByLocode($locode)
    {
        if (!preg_match("/^[A-Z]{2}\\s[A-Z0-9]{3}$/i", $locode)) {
            throw new \InvalidArgumentException("Invalid locode format, ex: DE FRA");
        }

        list($country, $code) = explode(" ", $locode, 2);

        return $this->getByCountryAndCode($country, $code);
    }

}