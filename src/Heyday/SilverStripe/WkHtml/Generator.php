<?php

namespace Heyday\SilverStripe\WkHtml;

use CacheCache\Cache;
use Heyday\SilverStripe\WkHtml\Input\InputInterface;
use Heyday\SilverStripe\WkHtml\Output\OutputInterface;
use Knp\Snappy\GeneratorInterface;

/**
 * Class Generator
 * @package Heyday\SilverStripe\WkHtml
 */
class Generator
{
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
     * @param GeneratorInterface $generator
     * @param InputInterface     $input
     * @param OutputInterface    $output
     * @param \CacheCache\Cache  $cache
     */
    public function __construct(
        GeneratorInterface $generator,
        InputInterface $input,
        OutputInterface $output,
        Cache $cache = null
    ) {
        $this->generator = $generator;
        $this->input = $input;
        $this->output = $output;
        $this->cache = $cache;
    }
    /**
     * Processes the pdf using the input and output that have been set.
     */
    public function process()
    {
        if (null !== $this->cache) {
            $contents = $this->input->process();
            if (!($output = $this->cache->load(md5($contents)))) {
                $this->cache->save(
                    $output = $this->output->process(
                        $contents,
                        $this->generator
                    )
                );
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
     * @param \Knp\Snappy\GeneratorInterface $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }
    /**
     * @return \Knp\Snappy\GeneratorInterface
     */
    public function getGenerator()
    {
        return $this->generator;
    }
    /**
     * @param \Heyday\SilverStripe\WkHtml\Input\InputInterface $input
     */
    public function setInput($input)
    {
        $this->input = $input;
    }
    /**
     * @return \Heyday\SilverStripe\WkHtml\Input\InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }
    /**
     * @param \Heyday\SilverStripe\WkHtml\Output\OutputInterface $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }
    /**
     * @return \Heyday\SilverStripe\WkHtml\Output\OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }
    /**
     * @param \CacheCache\Cache $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }
    /**
     * @return \CacheCache\Cache
     */
    public function getCache()
    {
        return $this->cache;
    }
}

