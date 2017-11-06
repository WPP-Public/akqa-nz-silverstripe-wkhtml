<?php

namespace Heyday\SilverStripe\WkHtml;

use SilverStripe\Core\Extension;

/**
 * Class ImageHelper
 * @package Heyday\SilverStripe\WkHtml
 */
class ImageHelper extends Extension
{
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