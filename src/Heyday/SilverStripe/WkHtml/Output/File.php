<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;

/**
 * Class File
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class File implements OutputInterface
{
    /**
     * @var bool
     */
    protected $overwrite = false;
    /**
     * @var bool
     */
    protected $path = false;

    /**
     * @param      $path
     * @param bool $overwrite
     */
    public function __construct($path, $overwrite = false)
    {
        $this->overwrite = $overwrite;
        if (file_exists($path) && !$overwrite) {
            throw new \RuntimeException('File already exists.');
        } elseif (!is_writable(dirname($path))) {
            throw new \RuntimeException('Directory is not writable.');
        } else {
            $this->path = $path;
        }
    }

    /**
     * @param                    $input
     * @param GeneratorInterface $generator
     * @return bool
     */
    public function process($input, GeneratorInterface $generator)
    {
        $generator->generateFromHtml($input, $this->path, array(), $this->overwrite);
        return $this->path;
    }
}
