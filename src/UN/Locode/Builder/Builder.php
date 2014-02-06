<?php

namespace UN\Locode\Builder;

use Symfony\Component\Console\Application;
use UN\Locode\Writer\YamlWriter;

/**
 * Class Builder
 * @package UN\Locode\Builder
 * @description Code list command line build interface
 */
class Builder extends Application
{
    /**
     * Builder constructor.
     */
    public function __construct()
    {
        parent::__construct('Welcome to UN\LOCODE code list builder', '1.0');

        $this->addCommands(array(
            new Build()
        ));
    }
}