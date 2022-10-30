<?php

namespace UN\Locode\Tests;

use PHPUnit\Framework\TestCase;
use UN\Locode\Locode;
use UN\Locode\Reader\YamlReader;

/**
 * Class LocodeTest.
 *
 * @description Basic Locode Tests
 */
class LocodeTest extends TestCase
{
    /**
     * @return Locode[][]
     */
    public function locodeObjectProvider()
    {
        return [
            'data path and reader are provided' => [new Locode($GLOBALS['data_path'], new YamlReader())],
            'data path and reader are empty' => [new Locode()],
        ];
    }

    /**
     * @dataProvider locodeObjectProvider
     * @covers {className}::{origMethodName}
     */
    public function testGetListByCountry(Locode $object)
    {
        $list = $object->getListByCountry('EE');
        $this->assertNotEmpty($list, 'The code list is empty');
    }

    /**
     * @dataProvider locodeObjectProvider
     * @covers {className}::{origMethodName}
     */
    public function testGetByCountryAndName(Locode $object)
    {
        $entry = $object->getByCountryAndName('EE', 'Tallinn');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('EE TLL', $entry->getLocode(), 'Invalid entry code');
        $this->assertEquals('TLL', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('EE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @dataProvider locodeObjectProvider
     * @covers {className}::{origMethodName}
     */
    public function testGetByCountryAndLocode(Locode $object)
    {
        $entry = $object->getByCountryAndCode('EE', 'TLL');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Tallinn', $entry->getName(), 'Invalid entry name');
        $this->assertEquals('TLL', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('EE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @dataProvider locodeObjectProvider
     * @covers {className}::{origMethodName}
     */
    public function testGetByLocode(Locode $object)
    {
        $entry = $object->getByLocode('DE FRA');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Frankfurt am Main', $entry->getName(), 'Invalid entry name');
        $this->assertEquals('FRA', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('DE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @dataProvider locodeObjectProvider
     * @covers {className}::{origMethodName}
     */
    public function testGetByLocodeInvalidFormat(Locode $object)
    {
        $this->expectException(\InvalidArgumentException::class);
        $object->getByLocode('EETLL');
    }
}
