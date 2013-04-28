<?php

namespace Heyday\SilverStripe\WkHtml;

use Heyday\SilverStripe\WkHtml\Input\InputInterface;
use Heyday\SilverStripe\WkHtml\Output\OutputInterface;
use Knp\Snappy\GeneratorInterface;

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
     */
    public function __construct(
        GeneratorInterface $generator,
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->generator = $generator;
        $this->input = $input;
        $this->output = $output;
    }
    /**
     * Processes the pdf using the input and output that have been set.
     */
    public function process()
    {
        return $this->output->process(
            $this->input->process(),
            $this->generator
        );
    }
}

