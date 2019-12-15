<?php

namespace UN\Locode;

use PHPUnit\Framework\TestCase;
use UN\Locode\Reader\YamlReader;

/**
 * Class LocodeTest
 * @package UN\Locode
 * @description Basic Locode Tests
 */
class LocodeTest extends TestCase
{

    /**
     * @var Locode
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Locode($GLOBALS['data_path'], new YamlReader());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetListByCountry()
    {
        $list = $this->object->getListByCountry('EE');
        $this->assertNotEmpty($list, "The code list is empty");
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByCountryAndName()
    {
        $entry = $this->object->getByCountryAndName('EE', 'Tallinn');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('EE TLL', $entry->getLocode(), 'Invalid entry code');
        $this->assertEquals('TLL', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('EE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByCountryAndLocode()
    {
        $entry = $this->object->getByCountryAndCode('EE', 'TLL');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Tallinn', $entry->getName(), 'Invalid entry name');
        $this->assertEquals('TLL', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('EE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByLocode()
    {
        $entry = $this->object->getByLocode('DE FRA');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Frankfurt am Main', $entry->getName(), 'Invalid entry name');
        $this->assertEquals('FRA', $entry->getCode(), 'Invalid entry code');
        $this->assertEquals('DE', $entry->getCountry(), 'Invalid entry country');
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByLocodeInvalidFormat()
    {
        $this->expectException(\InvalidArgumentException::class);
    	$this->object->getByLocode('EETLL');
    }

}
