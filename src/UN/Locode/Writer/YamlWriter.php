<?php

namespace UN\Locode\Writer;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlWriter
 * @package UN\Locode\Writer
 * @description Yaml writer
 */
class YamlWriter implements WriterInterface
{

    /**
     * {@inheritdoc}
     */
    public function write($path, $country, array $data)
    {
        $fileName = $path.'/'.$country.'.yaml';

        if (!file_put_contents($fileName, Yaml::dump($data))) {
            throw new \RuntimeException(sprintf("Unable to dump to file %s", $fileName));
        }
    }

}