<?php

namespace UN\Locode\Model;

/**
 * Class Locode
 * @package UN\Locode\Model
 * @description Locode data model
 */
class Locode {

    protected $ch;
    protected $locode;
    protected $name;
    protected $nameWoDiacritics;
    protected $subDiv;
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
    public function __construct(array $data) {
        foreach($data as $key => $value) {
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
        return $this->nameWoDiacritics;
    }

    /**
     * @return mixed
     */
    public function getSubDiv()
    {
        return $this->subDiv;
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

}