<?php

namespace UN\Locode\Writer;

/**
 * Interface WriterInterface.
 *
 * @description Writer interface
 */
interface WriterInterface
{
    /**
     * Writer data.
     *
     * @param string $path
     * @param string $country
     *
     * @return
     */
    public function write($path, $country, array $data);
}
