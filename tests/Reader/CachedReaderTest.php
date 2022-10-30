<?php

namespace UN\Locode\Tests\Reader;

use PHPUnit\Framework\TestCase;
use UN\Locode\Reader\CachedReader;

/**
 * Class CachedReaderTest.
 *
 * @description Cached Reader Tests
 */
class CachedReaderTest extends TestCase
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
