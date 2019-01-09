<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\Core\Injector\Injectable;
use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;
use SilverStripe\View\SSViewer_FromString;

/**
 * Class Template
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Template extends Viewer
{
    use Injectable;

    /**
     * @param array|string $template
     * @param null|ArrayData|array $data
     * @param bool $templateFromString
     */
    public function __construct(
        $template,
        $data = null,
        $templateFromString = false
    )
    {
        parent::__construct(
            $templateFromString ? SSViewer_FromString::create($template) : SSViewer::create($template),
            $data
        );
    }
}
