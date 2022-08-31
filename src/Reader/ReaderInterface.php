<?php

namespace UN\Locode\Reader;

/**
 * Interface ReaderInterface
 * @package UN\Locode\Reader
 * @description Reader interface
 */
interface ReaderInterface
{
    /**
     * Read data.
     *
     * @param string $path
     * @param string $country
     * @return array
     */
    public function read($path, $country);

    /**
     * Find entry by entry field value
     *
     * @param string $path
     * @param string $country
     * @param string $field
     * @param string $value
     * @internal param array $indices
     * @return mixed
     */
    public function findEntry($path, $country, $field, $value);
}
