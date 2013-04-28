<?php

namespace Heyday\SilverStripe\WkHtml;

use DataObjectDecorator;

/**
 * Class ImageHelper
 * @package Heyday\SilverStripe\WkHtml
 */
class ImageHelper extends DataObjectDecorator
{
    /**
     * @return array
     */
    public function extraStatics()
    {
        return array();
    }
    /**
     * @return mixed
     */
    public function Base64()
    {
        return singleton(__NAMESPACE__ . '\\TemplateHelper')->EmbedBase64Image(
            '/' . $this->owner->getRelativePath()
        );
    }
}