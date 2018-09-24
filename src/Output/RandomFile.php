<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Security\RandomGenerator;

/**
 * Class RandomFile
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class RandomFile implements OutputInterface
{
    use Injectable;

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
        if (!is_writable($dir)) {
            throw new \RuntimeException('Directory is not writable');
        }

        /** @var RandomGenerator $gen */
        $gen = Injector::inst()->create(RandomGenerator::class);
        $this->path = realpath($dir) . DIRECTORY_SEPARATOR . $gen->randomToken('sha1') . '.pdf';
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
