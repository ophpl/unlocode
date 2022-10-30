<?php

namespace UN\Locode\Tests\Model;

use PHPUnit\Framework\TestCase;
use UN\Locode\Model\Location;

/**
 * Class LocationTest
 * @package UN\Locode\Model
 * @description Location Model Tests
 */
class LocationTest extends TestCase
{
    public function locationDataProvider()
    {
        return [
            'array with lowercase key' => [
                [
                    'ch' => '',
                    'locode'=> 'EE AAR',
                    'name'=> 'Aaravete',
                    'namewodiacritics'=> 'Aaravete',
                    'subdiv'=> '52',
                    'function'=> '--3-----',
                    'status'=> 'RL',
                    'date'=> '1301',
                    'iata'=> '',
                    'coordinates'=> '5908N 02545E',
                    'remarks'=> '',
                ]
            ],
            'array with camelcase key' => [
                [
                    'ch' => '',
                    'locode'=> 'EE AAR',
                    'name'=> 'Aaravete',
                    'nameWoDiacritics'=> 'Aaravete',
                    'subDiv'=> '52',
                    'function'=> '--3-----',
                    'status'=> 'RL',
                    'date'=> '1301',
                    'IATA'=> '',
                    'coordinates'=> '5908N 02545E',
                    'remarks'=> '',
                ]
            ]
        ];
    }

    /**
     * @dataProvider locationDataProvider
     * @covers {className}::{origMethodName}
     */
    public function testLocationModel(array $data)
    {
        $location = new Location($data);

        $this->assertEquals('', $location->getCh());
        $this->assertEquals('EE AAR', $location->getLocode());
        $this->assertEquals('Aaravete', $location->getName());
        $this->assertEquals('Aaravete', $location->getNameWoDiacritics());
        $this->assertEquals('52', $location->getSubDiv());
        $this->assertEquals('--3-----', $location->getFunction());
        $this->assertEquals('RL', $location->getStatus());
        $this->assertEquals('1301', $location->getDate());
        $this->assertEquals('', $location->getIata());
        $this->assertEquals('5908N 02545E', $location->getCoordinates());
        $this->assertEquals('', $location->getRemarks());
        $this->assertEquals('AAR', $location->getCode());
        $this->assertEquals('EE', $location->getCountry());
    }
}
