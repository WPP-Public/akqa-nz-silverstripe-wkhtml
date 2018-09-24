<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injectable;

/**
 * Class Url
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Url implements InputInterface
{
    use Injectable;

    /**
     * @var bool|string
     */
    protected $url = false;

    /**
     * @var bool
     */
    protected $siteUrl = true;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->setUrl($url);
    }

    /**
     * @param $url
     * @throws \RuntimeException
     */
    public function setUrl($url)
    {
        $this->siteUrl = Director::is_site_url($url) || !Director::is_absolute_url($url);
        $this->url = $url;
    }

    /**
     * @return bool|false|mixed|string
     * @throws \SilverStripe\Control\HTTPResponse_Exception
     */
    public function process()
    {
        if ($this->siteUrl) {
            ob_start();
            Director::test($this->url)->output();
            return ob_get_clean();
        } else {
            return @file_get_contents($this->url);
        }
    }
}
