<?php

namespace Heyday\SilverStripe\WkHtml\Output;

use Knp\Snappy\GeneratorInterface;

/**
 * Class Browser
 * @package Heyday\SilverStripe\WkHtml\Output
 */
class Browser implements OutputInterface
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var
     */
    protected $contentType;
    /**
     * @var bool
     */
    protected $embed;
    /**
     * @param      $filename
     * @param      $contentType
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
        $this->embed = (bool) $embed;
    }

    /**
     * @param                    $input
     * @param GeneratorInterface $generator
     * @return Response
     */
    public function process($input, GeneratorInterface $generator)
    {
        $contents = $generator->getOutputFromHtml($input);

        $response = new HTTPResponse();
        $response->setStatusCode(200);
        $response->addHeader('Content-Length', strlen($contents));
        $response->addHeader('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        $response->addHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->addHeader('Cache-Control', 'public, must-revalidate, max-age=0');
        $response->addHeader('Pragma', 'public');

        if ($this->embed) {
            $response->addHeader('Content-Type', $this->contentType);
            $response->addHeader('Content-Disposition', 'inline; filename="' . $this->filename . '";');
        } else {
            $response->addHeader('Content-Description', 'File Transfer');
            $response->addHeader('Content-Type', 'application/force-download');
            $response->addHeader('Content-Type', 'application/octet-stream', false);
            $response->addHeader('Content-Type', 'application/download', false);
            $response->addHeader('Content-Type', $this->contentType, false);
            $response->addHeader('Content-Disposition', 'attachment; filename="' . $this->filename . '";');
            $response->addHeader('Content-Transfer-Encoding', 'binary');
        }

        return $response;
    }
}
