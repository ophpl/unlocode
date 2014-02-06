<?php

namespace UN\Locode\Builder;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

use UN\Locode\Writer\WriterInterface;
use UN\Locode\Writer\YamlWriter;

/**
 * Class Build
 * @package UN\Locode\Builder
 * @description Command to build code files
 */
class Build extends Command
{

    /**
     * Data url
     *
     * @var string
     */
    protected $url = 'http://www.unece.org/cefact/locode/service/location.html';

    /**
     * Build command constructor
     */
    public function __construct()
    {
        parent::__construct('build');
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Builds country list files.')
            ->addOption(
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path where to write data to',
                './data'
            )
            ->addOption(
                'format',
                null,
                InputOption::VALUE_OPTIONAL,
                'Format in which to export data',
                'yaml'
            )
            ->addOption(
                'countries',
                null,
                InputOption::VALUE_OPTIONAL,
                'Build for specific countries, ex: US,UK,EE'
            )
            ->setHelp(sprintf(
                '%sBuilds code list files.%s',
                PHP_EOL,
                PHP_EOL
            ));
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verbose = $input->getOption('verbose');

        $path = $input->getOption('path');
        $countries = $input->getOption('countries');

        if (null !== $countries) {
            $countries = explode(',', $countries);
            array_walk($countries, "trim");
        }

        if ($verbose) {
            $output->write(sprintf("Building country list (%s), fetching data from %s", ($countries === null ? 'all' : implode(',', $countries)), $this->url).PHP_EOL);
        }

        $countryList = $this->buildCountryList($this->url, $countries);

        if ($verbose) {
            $output->write(sprintf("Found %d countries", count($countryList)).PHP_EOL);
        }

        foreach ($countryList as $country) {
            $url = $this->buildUrl($country['link']);

            if ($verbose) {
                $output->write(sprintf("Fetching code list for %s from %s", $country['code'], $url).PHP_EOL);
            }

            $codes = $this->buildCodesList($url);

            if (empty($codes)) {
                throw new \RuntimeException(sprintf("Could not find any codes for %s", $country['code']));
            }

            if ($verbose) {
                $output->write(sprintf("Found %d codes", count($codes)).PHP_EOL);
            }

            $this->getWriter($input)->write($path, $country['code'], $codes);
        }

        $output->write(sprintf("Build completed").PHP_EOL);
    }

    /**
     * Load the html from the url and extract country list
     *
     * @param $url
     * @param $countries
     * @return array
     */
    protected function buildCountryList($url, $countries) {
        $crawler = new Crawler($this->getContent($url));

        return $crawler->filter('.contenttable tr')
            ->reduce(function (Crawler $node, $i) use ($countries) {
                if (count($node->filter('td')) == 0) {
                    return false;
                }

                $code = $node->filter('td:nth-of-type(1)')->text();

                return ($countries == null || in_array($code, $countries) ? true : false);
            })->each(function (Crawler $node, $i) {
                $code = $node->filter('td:nth-of-type(1)')->text();

                $link = $node->filter('td:nth-of-type(2) a')->attr("href");

                return array(
                    'code' => $code
                    , 'link' => $link
                );
            });
    }

    /**
     * Load the html from url and extract the locode list
     *
     * @param $url
     * @return array
     */
    protected function buildCodesList($url) {
        $crawler = new Crawler($this->getContent($url));

        $keys = array();

        return $crawler->filter('table:nth-of-type(3) tr')->reduce(function (Crawler $node, $i) use (&$keys) {
                // Read table headers and store them as keys
                if (empty($keys)) {
                    $keys = $node->filter('td')->extract(array('_text'));
                    $keys = array_map('strtolower', $keys);
                    return false;
                }

                return true;
            })->each(function (Crawler $node, $i) use ($keys) {
                $data = $node->filter('td')->extract(array('_text'));

                // Clean the extracted text values
                array_walk($data, function(&$value) {
                    // todo find a better way, a simple trim does not work
                    $value = htmlentities($value, null, 'utf-8');
                    $value = str_replace('&nbsp;', ' ', $value);
                    $value = preg_replace('/\s\s+/', ' ', $value);
                    $value = trim($value);
                    $value = html_entity_decode($value, null, 'utf-8');
                });

                return array_combine($keys, $data);
            });
    }

    /**
     * Build absolute url
     *
     * @param $url
     * @return string
     */
    protected function buildUrl($url) {
        $parts = parse_url($this->url);

        if (strpos($url, '../') === 0) {
            $url = substr($url, 3);
        }

        return sprintf("%s://%s/%s", $parts['scheme'], $parts['host'], $url);
    }

    /**
     * Get the content by url
     *
     * @param $url
     * @throws \RuntimeException
     * @return string
     */
    protected function getContent($url) {
        $content = file_get_contents($url);

        if (empty($content)) {
            throw new \RuntimeException(sprintf("%s returned empty response", $url));
        }

        return $content;
    }

    /**
     * Get writer
     *
     * @param InputInterface $input
     * @throws \RuntimeException
     * @return WriterInterface
     */
    protected function getWriter(InputInterface $input) {
        $format = $input->getOption("format");

        switch($format) {
            case 'yaml':
                return new YamlWriter();
            break;
        }

        throw new \RuntimeException(sprintf("Writer for format %s not found", $format));
    }

}