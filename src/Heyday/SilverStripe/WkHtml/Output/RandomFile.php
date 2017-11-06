<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;
use SilverStripe\Security\RandomGenerator;

/**
 * Class RandomFile
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class RandomFile implements OutputInterface
{
    /**
     * @var bool|string
     */
    protected $path;

    /**
     * @param $dir
     * @throws \RuntimeException
     */
    public function __construct($dir)
    {
        if (is_writable($dir)) {
            $gen = new RandomGenerator;
            $this->path = realpath($dir) . DIRECTORY_SEPARATOR . $gen->randomToken('sha1') . '.pdf';
        } else {
            throw new \RuntimeException('Directory is not writable');
        }
    }
    /**
     * @param                    $input
     * @param GeneratorInterface $generator
     * @return bool|string
     */
    public function process($input, GeneratorInterface $generator)
    {
        $generator->generateFromHtml($input, $this->path);
        return $this->path;
    }
}
