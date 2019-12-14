<?php

namespace UN\Locode\Reader;

use PHPUnit\Framework\TestCase;

/**
 * Class YamlReaderTest
 * @package UN\Locode\Reader
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
