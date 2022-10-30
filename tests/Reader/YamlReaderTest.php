<?php

namespace UN\Locode\Tests\Reader;

use PHPUnit\Framework\TestCase;
use UN\Locode\Reader\YamlReader;

/**
 * Class YamlReaderTest.
 *
 * @description Yaml Reader Tests
 */
class YamlReaderTest extends TestCase
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
