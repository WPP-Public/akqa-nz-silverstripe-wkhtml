<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Injector\Injectable;

/**
 * Class Browser
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class Browser implements OutputInterface
{
    use Injectable;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var bool
     */
    protected $embed;

    /**
     * @param string $filename
     * @param string $contentType
     * @param bool $embed
     * @throws \RuntimeException
     */
    public function __construct($filename, $contentType, $embed = false)
    {
        if (is_string($filename)) {
            $this->filename = $filename;
        } else {
            throw new \RuntimeException('You must provide a filename');
        }

        $this->contentType = $contentType;
        $this->embed = (bool)$embed;
    }

    /**
     * @param array|string $input
     * @param GeneratorInterface $generator
     * @return HTTPResponse
     */
    public function process($input, GeneratorInterface $generator)
    {
        $contents = $generator->getOutputFromHtml($input);

        $response = HTTPResponse::create($contents, 200);
        $response->addHeader('Content-Length', strlen($contents));
        $response->addHeader('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        $response->addHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->addHeader('Cache-Control', 'public, must-revalidate, max-age=0');
        $response->addHeader('Pragma', 'public');
        $response->addHeader('Content-Type', $this->contentType);

        if ($this->embed) {
            $response->addHeader('Content-Disposition', 'inline; filename="' . $this->filename . '";');
        } else {
            $response->addHeader('Content-Description', 'File Transfer');
            $response->addHeader('Content-Disposition', 'attachment; filename="' . $this->filename . '";');
            $response->addHeader('Content-Transfer-Encoding', 'binary');
        }

        return $response;
    }
}
