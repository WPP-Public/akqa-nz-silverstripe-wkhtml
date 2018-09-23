<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use Heyday\SilverStripe\WkHtml\EchoValue;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request
     */
    protected $object;
    /**
     * @var
     */
    protected $handleMethod;
    /**
     * @var
     */
    protected $request;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->request = $this->getMockBuilder('SS_HTTPRequest')
            ->disableOriginalConstructor()
            ->getMock();

        $this->handleMethod = $this->getMockBuilder('ReflectionMethod')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new Request(
            $this->request
        );
    }
    /**
     * @expectedException RuntimeException
     */
    public function testSetSessionException()
    {
        $this->object->setSession('test');
    }

    public function testSetSessionSession()
    {
        $session = $this->getMockBuilder('Session')
            ->disableOriginalConstructor()
            ->getMock();
        $this->object->setSession($session);
        $this->assertEquals($session, $this->object->getSession());
    }

    public function testSetSessionArray()
    {
        $this->object->setSession(array());
        $this->assertEquals(new \Session(array()), $this->object->getSession());
    }

    public function testProcessString()
    {
        $this->handleMethod
            ->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue('test'));

        $this->object->setHandleMethod($this->handleMethod);

        $this->assertEquals('test', $this->object->process());
    }

    public function testProcessResponse()
    {
        $response = $this->getMock('SS_HTTPResponse');

        $response->expects($this->any())
            ->method('output')
            ->will(new EchoValue('test'));

        $this->handleMethod->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue($response));

        $this->object->setHandleMethod($this->handleMethod);

        $this->assertEquals('test', $this->object->process());
    }
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Can't handle output from request
     */
    public function testProcessBadReturn()
    {
        $this->handleMethod->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue(array()));

        $this->object->setHandleMethod($this->handleMethod);

        $this->assertEquals('test', $this->object->process());
    }
}


