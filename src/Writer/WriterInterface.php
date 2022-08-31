<?php

namespace UN\Locode\Writer;

/**
 * Interface WriterInterface
 * @package UN\Locode\Writer
 * @description Writer interface
 */
interface WriterInterface
{
    /**
     * Writer data.
     *
     * @param string $path
     * @param string $country
     * @param array $data
     * @return
     */
    public function write($path, $country, array $data);
}
