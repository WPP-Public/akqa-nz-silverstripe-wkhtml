<?php

namespace Heyday\SilverStripe\WkHtml;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    protected $object;
    protected $outputMock;
    protected $inputMock;
    protected $generatorMock;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Generator(
            $this->generatorMock = $this->getMock('Knp\Snappy\GeneratorInterface'),
            $this->inputMock = $this->getMock('Heyday\SilverStripe\WkHtml\Input\InputInterface'),
            $this->outputMock = $this->getMock('Heyday\SilverStripe\WkHtml\Output\OutputInterface')
        );
    }

    public function testProcess()
    {
        $this->outputMock->expects($this->once())
            ->method('process')
            ->with(
                $this->equalTo(null),
                $this->generatorMock
            );
        $this->inputMock->expects($this->once())
            ->method('process');
        $this->object->process();
    }
}
