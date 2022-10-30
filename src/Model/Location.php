<?php

namespace UN\Locode\Model;

/**
 * Class Location
 * @package UN\Locode\Model
 * @description Location data model
 */
class Location
{
    protected $ch;
    protected $locode;
    protected $name;
    protected $namewodiacritics;
    protected $subdiv;
    protected $function;
    protected $status;
    protected $date;
    protected $iata;
    protected $coordinates;
    protected $remarks;

    /**
     * Construct model from data array
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $key = strtolower($key);
            $this->$key = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getCh()
    {
        return $this->ch;
    }

    /**
     * @return mixed
     */
    public function getLocode()
    {
        return $this->locode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNameWoDiacritics()
    {
        return $this->namewodiacritics;
    }

    /**
     * @return mixed
     */
    public function getSubDiv()
    {
        return $this->subdiv;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getIata()
    {
        return $this->iata;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Get city code
     *
     * @return string
     */
    public function getCode()
    {
        return substr($this->locode, 3);
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return substr($this->locode, 0, 2);
    }
}
