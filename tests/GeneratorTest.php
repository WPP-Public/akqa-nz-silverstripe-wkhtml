<?php

namespace Heyday\SilverStripe\WkHtml;

use Heyday\SilverStripe\WkHtml\Input\InputInterface;
use Heyday\SilverStripe\WkHtml\Output\OutputInterface;
use Knp\Snappy\GeneratorInterface;
use SilverStripe\Dev\SapphireTest;

class GeneratorTest extends SapphireTest
{
    /**
     * @var Generator
     */
    protected $object;

    /**
     * @var OutputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $outputMock;

    /**
     * @var InputInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $inputMock;

    /**
     * @var GeneratorInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $generatorMock;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->generatorMock = $this->createMock(GeneratorInterface::class);
        $this->inputMock = $this->createMock(InputInterface::class);
        $this->outputMock = $this->createMock(OutputInterface::class);

        $this->object = Generator::create($this->generatorMock, $this->inputMock, $this->outputMock);
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
