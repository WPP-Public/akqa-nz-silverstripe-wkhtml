<?php

namespace Heyday\SilverStripe\WkHtml;

use SilverStripe\Assets\File;
use SilverStripe\ORM\DataExtension;

/**
 * Class ImageHelper
 * @package Heyday\SilverStripe\WkHtml
 * @property File|null $owner
 */
class ImageHelper extends DataExtension
{
    /**
     * @return mixed
     */
    public function Base64()
    {
        return TemplateHelper::singleton()->EmbedBase64Image($this->owner->getAbsoluteURL());
    }
}
