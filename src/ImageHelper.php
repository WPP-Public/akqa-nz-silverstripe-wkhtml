<?php

namespace Heyday\SilverStripe\WkHtml;

/**
 * Class ImageHelper
 * @package Heyday\SilverStripe\WkHtml
 */
class ImageHelper extends \DataExtension
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