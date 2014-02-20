<?php

namespace UN\Locode\Reader;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlReader
 * @package UN\Locode\Reader
 * @description Yaml reader
 */
class YamlReader implements ReaderInterface
{

    /**
     * @var Object $cache doctrine cache if provided
     */
    protected $cache = null;

    /**
     * @param Object $cache optional doctrine cache instance
     * @throws \InvalidArgumentException incorrect cache provider
     */
    public function __construct($cache = null)
    {
        if (null !== $cache && !is_a($cache, 'Doctrine\Common\Cache\Cache')) {
            throw new \InvalidArgumentException(sprintf("Provided argument `cache` must be an instance of `Doctrine\\Common\\Cache\\Cache`, an instance of `%s` provided", get_class($cache)));
        }

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

        $fileName = $path . '/' . $country . '.yaml';

        if (!file_exists($fileName)) {
            throw new \RuntimeException(sprintf(
                'The data file "%s" does not exist.',
                $fileName
            ));
        }

        if (!is_file($fileName)) {
            throw new \RuntimeException(sprintf(
                'The "%s" is not a file.',
                $fileName
            ));
        }

        return $this->saveCache($country, Yaml::parse($fileName));
    }

    /**
     * {@inheritdoc}
     */
    public function findEntry($path, $country, $field, $value)
    {
        $country = strtolower($country);

        $data = $this->read($path, $country);

        foreach($data as $entry) {
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
    protected function getCache($key) {
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
    protected function saveCache($key, array $data) {
        if (null === $this->cache) {
            return $data;
        }

        if (!$this->cache->save($key, $data)) {
            throw new \RuntimeException("Unable to save data to cache");
        }

        return $data;
    }

}