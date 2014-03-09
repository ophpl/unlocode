<?php

namespace UN\Locode;

use UN\Locode\Model\Location;

/**
 * Interface LocodeInterface
 * @package UN\Locode
 * @description Locode interface
 */
interface LocodeInterface
{

    /**
     * Get list by country
     *
     * @param string $country ISO 3166-1 country code
     * @return Location[]
     */
    public function getListByCountry($country);

    /**
     * Get by country and city name
     *
     * @param string $country ISO 3166-1 country code
     * @param string $name city name
     * @return null|Location
     */
    public function getByCountryAndName($country, $name);

    /**
     * Get by country and code
     *
     * @param string $country ISO 3166-1 country code
     * @param string $code city code
     * @return null|Location
     */
    public function getByCountryAndCode($country, $code);

    /**
     * Get by locode
     *
     * @param string $locode UN locode
     * @throws \InvalidArgumentException
     * @return null|Location
     */
    public function getByLocode($locode);

}