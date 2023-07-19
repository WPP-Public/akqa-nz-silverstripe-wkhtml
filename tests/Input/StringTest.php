<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\Dev\SapphireTest;

/**
 * Class StringTest
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class StringTest extends SapphireTest
{
    /**
     * @var TextString
     */
    protected $object;
    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->object = TextString::create('test');
    }
    /**
     *
     */
    public function testProcess()
    {
        $this->assertStringContainsString(
            'test',
            $this->object->process()
        );
    }
}
