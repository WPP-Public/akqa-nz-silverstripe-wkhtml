<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\Core\Injector\Injectable;

/**
 * Class TextString
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class TextString implements InputInterface
{
    use Injectable;

    /**
     * @param $string
     * @param string $string
     */
    public function __construct(protected $string)
    {
    }

    /**
     * @return mixed
     */
    public function process()
    {
        return $this->string;
    }
}
