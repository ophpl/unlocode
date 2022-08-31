<?php

namespace UN\Locode\Reader;

use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Cache\Cache;

/**
 * Class CachedReader
 * @package UN\Locode\Reader
 * @description Cached reader
 */
class CachedReader implements ReaderInterface
{
    /**
     * @var Object $cache doctrine cache if provided
     */
    protected $cache = null;

    protected $reader = null;

    /**
     * @param ReaderInterface $reader actual cache reader
     * @param Cache $cache doctrine cache instance
     */
    public function __construct(ReaderInterface $reader, Cache $cache)
    {
        $this->reader = $reader;
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function read($path, $country)
    {
        $country = strtolower($country);

        $data = $this->getCache($country);

        if (null !== $data) {
            return $data;
        }

        return $this->saveCache($country, $this->reader->read($path, $country));
    }

    /**
     * {@inheritdoc}
     */
    public function findEntry($path, $country, $field, $value)
    {
        $country = strtolower($country);

        $data = $this->read($path, $country);

        foreach ($data as $entry) {
            if ($entry[$field] == $value) {
                return $entry;
            }
        }

        return null;
    }

    /**
     * Get data from cache, if cache provider is set
     *
     * @param string $key
     * @return array
     */
    protected function getCache($key)
    {
        if (null === $this->cache) {
            return null;
        }

        if (!$data = $this->cache->fetch($key)) {
            return null;
        }

        return $data;
    }

    /**
     * Save data to cache
     * @param string $key
     * @param array $data
     * @throws \RuntimeException thrown if data could not be saved to cache
     * @return array
     */
    protected function saveCache($key, array $data)
    {
        if (null === $this->cache) {
            return $data;
        }

        if (!$this->cache->save($key, $data)) {
            throw new \RuntimeException("Unable to save data to cache");
        }

        return $data;
    }
}
