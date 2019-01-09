<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;

interface OutputInterface
{
    /**
     * @param                                $input
     * @param \Knp\Snappy\GeneratorInterface $generator
     * @return mixed
     */
    public function process($input, GeneratorInterface $generator);
}
