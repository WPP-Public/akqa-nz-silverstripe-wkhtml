<?php

namespace Heyday\SilverStripe\WkHtml;

use PHPUnit_Framework_MockObject_Stub;
use PHPUnit_Framework_MockObject_Invocation;
use PHPUnit_Util_Type;

class EchoValue implements PHPUnit_Framework_MockObject_Stub
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function invoke(PHPUnit_Framework_MockObject_Invocation $invocation)
    {
        echo $this->value;
    }

    public function toString()
    {
        return sprintf(
            'echo user-specified value %s',
            PHPUnit_Util_Type::toString($this->value)
        );
    }
}