<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use Director;

/**
 * Class Url
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Url implements InputInterface
{
    /**
     * @var bool
     */
    protected $url = false;
    /**
     * @var bool
     */
    protected $siteUrl = true;
    /**
     * @param $url
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
        if (Director::is_site_url($url)) {
            $this->siteUrl = true;
        } elseif (Director::is_absolute_url($url)) {
            $this->siteUrl = false;
        } else {
            throw new \RuntimeException('URL is not well formed');
        }
        $this->url = $url;
    }
    /**
     * @return string
     */
    public function process()
    {
        if ($this->siteUrl) {
            ob_start();
            Director::direct($this->url);
            return ob_get_clean();
        } else {
            return @file_get_contents($this->url);
        }
    }
}
