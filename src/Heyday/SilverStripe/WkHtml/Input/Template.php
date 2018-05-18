<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\View\SSViewer;
use SilverStripe\View\SSViewer_FromString;

/**
 * Class Template
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Template extends Viewer
{
    /**
     * @param array|string $template
     * @param null|ArrayData|array $data
     * @param bool $templateFromString
     */
    public function __construct(
        $template,
        $data = null,
        $templateFromString = false
    ) {
        parent::__construct(
            $templateFromString ? new SSViewer_FromString($template) : new SSViewer($template),
            $data
        );
    }
}
