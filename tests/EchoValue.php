<?php

namespace Heyday\SilverStripe\WkHtml;

use PHPUnit\Framework\MockObject\Stub\Stub;
use PHPUnit\Framework\MockObject\Invocation;

class EchoValue implements Stub
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function invoke(Invocation $invocation)
    {
        echo $this->value;
    }

    public function toString(): string
    {
        return sprintf(
            'echo user-specified value %s',
            $this->value
        );
    }
}
