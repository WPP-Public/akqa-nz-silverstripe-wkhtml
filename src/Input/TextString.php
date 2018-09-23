<?php

namespace Heyday\SilverStripe\WkHtml\Input;

/**
 * Class TextString
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class TextString implements InputInterface
{
    /**
     * @var string
     */
    protected $string;
    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }
    /**
     * @return mixed
     */
    public function process()
    {
        return $this->string;
    }
}
