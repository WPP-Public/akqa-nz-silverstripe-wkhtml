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
     * @param string $header
     * @param string $value
     * @param bool   $replace
     */
    public function addHeader($header, $value, $replace = true) {
        $this->headers[$header] = array($value, $replace);
    }
    /**
     *
     */
    public function output()
    {
        if (!headers_sent()) {
            header($_SERVER['SERVER_PROTOCOL'] . " $this->statusCode " . $this->getStatusDescription());
            foreach($this->headers as $header => $value) {
                list($value, $replace) = $value;
                header("$header: $value", $replace);
            }
        }
        echo $this->body;
    }
}