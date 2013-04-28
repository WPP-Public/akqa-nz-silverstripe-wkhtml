<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;

class String implements OutputInterface
{
    /**
     * @param                    $input
     * @param GeneratorInterface $generator
     * @return bool|string
     */
    public function process($input, GeneratorInterface $generator)
    {
        return $generator->getOutputFromHtml($input);
    }
}
