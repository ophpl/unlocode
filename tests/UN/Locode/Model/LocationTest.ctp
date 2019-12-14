<?php

namespace UN\Locode\Model;

use PHPUnit\Framework\TestCase;
use UN\Locode\Locode;

/**
 * Class LocationTest
 * @package UN\Locode\Model
 * @description Location Model Tests
 */
class LocationTest extends TestCase
{

	/**
	 * @var Location
	 */
	protected $object;

	/**
	 * Initialize Location.
	 */
	protected function setUp(): void
	{
		$this->object = new Location(new Locode())->getByLocode('DE NG7'));
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetCh()
	{
		$this->assertEquals('X', $this->object->getCh(), 'Invalid Change Indicator');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetLocode()
	{
		$this->assertEquals('DE NG7', $this->object->getLocode(), 'Invalid Locode');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetName()
	{
		$this->assertEquals('Neuengönna', $this->object->getName(), 'Invalid Name');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetNameWoDiacritics()
	{
		$this->assertEquals('Neuengonna', $this->object->getNameWoDiacritics(), 'Invalid Name Without Diacritic Signs');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetSubDiv()
	{
		$this->assertEquals('TH', $this->object->getSubDiv(), 'Invalid SubDivision');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetFunction()
	{
		$this->assertEquals('--3-----', $this->object->getFunction(), 'Invalid Function');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetStatus()
	{
		$this->assertEquals('XX', $this->object->getStatus(), 'Invalid Status');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetDate()
	{
		$this->assertEquals('1907', $this->object->getDate(), 'Invalid Date');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetIata()
	{
		$this->assertEquals('', $this->object->getIata(), 'Invalid IATA');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetCoordinates()
	{
		$this->assertEquals('5059N 01139E', $this->object->getCoordinates(), 'Invalid Coordinates');
	}

	/**
	 * @covers {className}::{origMethodName}
	 */
	public function testGetRemarks()
	{
		$this->assertEquals('Use DE NPO', $this->object->getRemarks(), 'Invalid Remarks');
	}

}