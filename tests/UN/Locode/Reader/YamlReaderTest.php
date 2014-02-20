<?php

namespace UN\Locode\Reader;

use UN\Locode\Reader\YamlReader;

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

    /**
     * @covers {className}::{origMethodName}
     * @expectedException \InvalidArgumentException
     */
    public function testReaderConstructorInvalidCacheProvider()
    {
        new YamlReader(new \DateTime());
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testReaderConstructorValidCacheProvider()
    {
        if (class_exists('Doctrine\Common\Cache')) {
            $cache = new \Doctrine\Common\Cache\ArrayCache();
            $reader = new YamlReader($cache);
            $this->assertInstanceOf('UN\Locode\Reader\YamlReader', $reader);
        }
    }

}
