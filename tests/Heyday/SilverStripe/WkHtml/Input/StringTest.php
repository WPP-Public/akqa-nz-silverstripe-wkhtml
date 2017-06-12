<?php

namespace Heyday\SilverStripe\WkHtml\Input;

/**
 * Class StringTest
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TextString
     */
    protected $object;
    /**
     *
     */
    protected function setUp()
    {
        $this->object = new TextString('test');
    }
    /**
     *
     */
    public function testProcess()
    {
        $this->assertEquals('test', $this->object->process());
    }
}
