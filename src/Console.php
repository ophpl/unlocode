<?php

namespace UN\Locode;

use Symfony\Component\Console\Application;
use UN\Locode\Command\Build;

/**
 * Class Console.
 *
 * @description Console Application
 */
class Console extends Application
{
    /**
     * Builder constructor.
     */
    public function __construct()
    {
        parent::__construct('Welcome to UN\LOCODE console', '1.0');

        $this->addCommands([
            new Build(),
        ]);
    }
}
