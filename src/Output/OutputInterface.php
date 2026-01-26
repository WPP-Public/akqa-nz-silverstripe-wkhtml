<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;

interface OutputInterface
{
    /**
     * @param                                $input
     * @param GeneratorInterface $generator
     * @return mixed
     */
    public function process($input, GeneratorInterface $generator);
}
