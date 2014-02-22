<?php

namespace UN\Locode\Reader;

/**
 * Class YamlReaderTest
 * @package UN\Locode\Reader
 * @description Yaml Reader Tests
 */
class YamlReaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers {className}::{origMethodName}
     */
    public function testReaderConstructorNull()
    {
        $reader = new YamlReader();
        $this->assertInstanceOf('UN\Locode\Reader\YamlReader', $reader);
    }

}
