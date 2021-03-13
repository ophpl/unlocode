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
     * {@inheritdoc}
     */
    public function read($path, $country)
    {
        $country = strtolower($country);

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

        return Yaml::parseFile($fileName);
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

}