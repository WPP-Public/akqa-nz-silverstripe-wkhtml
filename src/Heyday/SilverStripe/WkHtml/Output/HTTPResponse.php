<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use SS_HTTPResponse;

/**
 * Class Response
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class HTTPResponse extends SS_HTTPResponse
{
    /**
     * @var array
     */
    protected $replace = array();
    /**
     * @param string $header
     * @param string $value
     * @param bool   $replace
     */
    public function addHeader($header, $value, $replace = true) {
        $this->headers[$header] = $value;
        $this->replace["$header: $value"] = $replace;
    }
    /**
     *
     */
    public function output()
    {
        if (!headers_sent()) {
            header($_SERVER['SERVER_PROTOCOL'] . " $this->statusCode " . $this->getStatusDescription());
            foreach($this->headers as $header => $value) {
                $header = "$header: $value";
                header($header, $this->shouldReplace($header));
            }
        }
        echo $this->body;
    }
    /**
     * @param $header
     * @return bool
     */
    protected function shouldReplace($header)
    {
        if (array_key_exists($header, $this->replace)) {
            return $this->replace[$header];
        } else {
            return true;
        }
    }
}