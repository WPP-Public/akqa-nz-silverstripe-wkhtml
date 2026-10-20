<?php

namespace Heyday\SilverStripe\WkHtml;

use SilverStripe\Assets\File;
use SilverStripe\Core\Extension;

/**
 * Class ImageHelper
 * @package Heyday\SilverStripe\WkHtml
 * @property File|null $owner
 */
class ImageHelper extends Extension
{
    public $owner;

    /**
     * @return mixed
     */
    public function Base64()
    {
        return TemplateHelper::singleton()->EmbedBase64Image($this->owner->getAbsoluteURL());
    }
}
