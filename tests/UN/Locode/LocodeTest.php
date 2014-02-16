<?php

namespace UN\Locode;

use UN\Locode\Reader\YamlReader;

/**
 * Class LocodeTest
 * @package UN\Locode
 * @description Basic Locode Tests
 */
class LocodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Locode
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Locode($GLOBALS['data_path'], new YamlReader());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
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
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByCountryAndLocode()
    {
        $entry = $this->object->getByCountryAndCode('EE', 'TLL');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Tallinn', $entry->getName(), 'Invalid entry name');
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetByLocode()
    {
        $entry = $this->object->getByLocode('DE FRA');

        $this->assertNotNull($entry, 'Entry not found');
        $this->assertEquals('Frankfurt am Main', $entry->getName(), 'Invalid entry name');
    }

    /**
     * @covers {className}::{origMethodName}
     * @expectedException \InvalidArgumentException
     */
    public function testGetByLocodeInvalidFormat()
    {
        $this->object->getByLocode('EETLL');
    }

}