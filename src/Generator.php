<?php

namespace Heyday\SilverStripe\WkHtml;

use Heyday\SilverStripe\WkHtml\Input\InputInterface;
use Heyday\SilverStripe\WkHtml\Output\OutputInterface;
use Knp\Snappy\GeneratorInterface;
use Knp\Snappy\Image;
use Knp\Snappy\Pdf;
use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Injector\Injector;

class Generator
{
    use Injectable;

    /**
     * @var array
     */
    private static $dependencies = [
        'cache' => '%$' . CacheInterface::class . '.wkhtml',
    ];

    /**
     * @var CacheInterface
     */
    public $cache;

    /**
     * @var \Knp\Snappy\GeneratorInterface
     */
    protected $generator;

    /**
     * @var Output\OutputInterface
     */
    protected $output;

    /**
     * @var Input\InputInterface
     */
    protected $input;

    /**
     * @var bool
     */
    protected $cacheOutput;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param bool $cache
     * @param string $pdfGeneratorSpec
     * @return static
     */
    public static function pdf(InputInterface $input, OutputInterface $output, $cache = true, $pdfGeneratorSpec = Pdf::class)
    {
        return static::create(Injector::inst()->get($pdfGeneratorSpec), $input, $output, $cache);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param bool $cache
     * @param string $imageGeneratorSpec
     * @return static
     */
    public static function image(InputInterface $input, OutputInterface $output, $cache = true, $imageGeneratorSpec = Image::class)
    {
        return static::create(Injector::inst()->get($imageGeneratorSpec), $input, $output, $cache);
    }

    /**
     * @param GeneratorInterface $generator
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param bool $cache
     */
    public function __construct(
        GeneratorInterface $generator,
        InputInterface $input,
        OutputInterface $output,
        $cache = true
    )
    {
        $this->generator = $generator;
        $this->input = $input;
        $this->output = $output;
        $this->cacheOutput = $cache;
    }

    /**
     * Processes the pdf using the input and output that have been set.
     */
    public function process()
    {
        if ($this->cacheOutput && $this->cache) {
            $contents = $this->input->process();
            $key = md5($contents);

            if (!($output = $this->cache->get($key))) {
                $output = $this->output->process($contents, $this->generator);
                $this->cache->set($key, $output);
            }
        } else {
            $output = $this->output->process(
                $this->input->process(),
                $this->generator
            );
        }

        return $output;
    }

    /**
     * @return \Knp\Snappy\GeneratorInterface
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * @param \Knp\Snappy\GeneratorInterface $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return \Heyday\SilverStripe\WkHtml\Input\InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param \Heyday\SilverStripe\WkHtml\Input\InputInterface $input
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @return \Heyday\SilverStripe\WkHtml\Output\OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param \Heyday\SilverStripe\WkHtml\Output\OutputInterface $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @return CacheInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param CacheInterface $cache
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }
}

