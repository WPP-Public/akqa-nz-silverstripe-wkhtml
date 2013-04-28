<?php

namespace Heyday\SilverStripe\WkHtml\Input;

/**
 * Class StringTest
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var String
     */
    protected $object;
    /**
     *
     */
    protected function setUp()
    {
        $this->object = new String('test');
    }
    /**
     *
     */
    public function testProcess()
    {
        $this->assertEquals('test', $this->object->process());
    }
}
