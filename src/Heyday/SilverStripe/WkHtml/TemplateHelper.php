<?php

namespace Heyday\SilverStripe\WkHtml;

use ViewableData;

/**
 * Class TemplateHelper
 * @package Heyday\SilverStripe\WkHtml
 */
class TemplateHelper extends ViewableData
{
    /**
     * @param $css
     * @return string
     */
    public function EmbedCss($css)
    {
        if (file_exists(BASE_PATH . $css)) {
            return '<style>' . file_get_contents(BASE_PATH . $css) . '</style>';
        }
    }
    /**
     * @param $image
     * @return string
     */
    public function EmbedBase64Image($image)
    {
        if (file_exists(BASE_PATH . $image)) {
            return 'data:image/png;base64,' . base64_encode(file_get_contents(BASE_PATH . $image));
        }
    }
}