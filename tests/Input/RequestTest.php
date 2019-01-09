<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use Heyday\SilverStripe\WkHtml\EchoValue;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Session;
use SilverStripe\Dev\SapphireTest;

class RequestTest extends SapphireTest
{
    /**
     * @var Request
     */
    protected $object;

    /**
     * @var \ReflectionMethod|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $handleMethod;

    /**
     * @var HTTPRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     *
     */
    public function testSetSessionException()
    {
        $this->expectException(\RuntimeException::class);
        $this->object->setSession('test');
    }

    public function testSetSessionSession()
    {
        /** @var Session $session */
        $session = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->object->setSession($session);
        $this->assertEquals($session, $this->object->getSession());
    }

    public function testSetSessionArray()
    {
        $this->object->setSession([]);
        $this->assertEquals(new Session([]), $this->object->getSession());
    }

    public function testProcessString()
    {
        $this->handleMethod
            ->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue('test'));

        $this->object->setHandleMethod($this->getHandleMethodCallable());

        $this->assertEquals('test', $this->object->process());
    }

    /**
     * @return \Closure
     */
    protected function getHandleMethodCallable()
    {
        return function (HTTPRequest $request) {
            return $this->handleMethod->invoke(Director::singleton(), $request);
        };
    }

    public function testProcessResponse()
    {
        $response = $this->createMock(HTTPResponse::class);

        $response->expects($this->any())
            ->method('output')
            ->will(new EchoValue('test'));

        $this->handleMethod->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue($response));

        $this->object->setHandleMethod($this->getHandleMethodCallable());

        $this->assertEquals('test', $this->object->process());
    }

    /**
     *
     */
    public function testProcessBadReturn()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Can't handle output from request");

        $this->handleMethod->expects($this->any())
            ->method('invoke')
            ->will($this->returnValue([]));

        $this->object->setHandleMethod($this->getHandleMethodCallable());

        $this->assertEquals('test', $this->object->process());
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->request = $this->getMockBuilder(HTTPRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handleMethod = $this->getMockBuilder(\ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = Request::create($this->request);
    }
}


