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
     * The outputter to use.
     */
    protected $outputter;
    /**
     * The inputter to use
     */
    protected $inputter;
    /**
     * Constructor. Create the class and set the input and output it exists.
     */
    public function __construct(
        GeneratorInterface $generator,
        InputInterface $inputter,
        OutputInterface $outputter
    ) {
        $this->generator = $generator;
        $this->inputter = $inputter;
        $this->outputter = $outputter;
    }
    /**
     * Sets the inputter ensuring it implements the interface
     */
    public function setInputter(InputInterface $inputter)
    {
        $this->inputter = $inputter;
    }
    /**
     * Sets the outputter ensuring it implements the interface
     */
    public function setOutputter(OutputInterface $outputter)
    {
        $this->outputter = $outputter;
    }
    /**
     * The almighty process method. This processes the pdf using the inputters and outputters that have been set.
     */
    public function process()
    {
        return $this->outputter->process(
            $this->inputter->process(),
            $this->generator
        );
    }
}

