<?php

namespace Heyday\SilverStripe\WkHtml;

use SilverStripe\View\ViewableData;

/**
 * Class TemplateHelper
 * @package Heyday\SilverStripe\WkHtml
 */
class TemplateHelper extends ViewableData
{
    /**
     * @param string $css
     * @return string|null
     */
    public function EmbedCss($css)
    {
        if (file_exists(BASE_PATH . $css)) {
            return '<style>' . file_get_contents(BASE_PATH . $css) . '</style>';
        }

        return null;
    }

    /**
     * Make a data URL from an image file
     * @param string $path
     * @return string|null
     */
    public function EmbedBase64Image($path)
    {
        $mime = $this->getMimeType($path);
        if ($mime) {
            $content = file_get_contents($path);

            if ($content) {
                return "data:{$mime};base64," . base64_encode($content);
            }
        }

        return null;
    }

    /**
     * Guess mime type based on file extension
     * @param  string $path
     * @return string|null
     */
    public function getMimeType($path)
    {
        $mimeTypes = [
            'png'  => 'image/png',
            'jpe'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg'  => 'image/jpeg',
            'gif'  => 'image/gif',
            'bmp'  => 'image/bmp',
            'ico'  => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif'  => 'image/tiff',
            'svg'  => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
        ];

        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (array_key_exists($ext, $mimeTypes)) {
            return $mimeTypes[$ext];
        }

        return null;
    }
}
