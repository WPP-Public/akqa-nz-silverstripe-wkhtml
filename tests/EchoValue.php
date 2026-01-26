<?php

namespace Heyday\SilverStripe\WkHtml;

use PHPUnit\Framework\MockObject\Invocation;
use PHPUnit\Framework\MockObject\Stub\Stub;

class EchoValue implements Stub
{
    public function __construct(protected $value)
    {
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
