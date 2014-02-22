<?php

namespace UN\Locode\Reader;

/**
 * Class CachedReaderTest
 * @package UN\Locode\Reader
 * @description Cached Reader Tests
 */
class CachedReaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers {className}::{origMethodName}
     */
    public function testCacheReader()
    {
        $reader = $this->getMockBuilder('UN\Locode\Reader\ReaderInterface')->getMock();
        $cache = $this->getMockBuilder('Doctrine\Common\Cache\Cache')->getMock();
        $reader = new CachedReader($reader, $cache);
        $this->assertInstanceOf('UN\Locode\Reader\CachedReader', $reader);
    }

}
