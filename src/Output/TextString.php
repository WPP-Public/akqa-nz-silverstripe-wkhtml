<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;
use SilverStripe\Core\Injector\Injectable;

class TextString implements OutputInterface
{
    use Injectable;

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
