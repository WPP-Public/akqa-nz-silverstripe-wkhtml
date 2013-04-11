<?php

class SilverStripeWkHtmlToPdfBrowserOutput implements SilverStripeWkHtmlToPdfOutputter
{

    protected $embed = false;

    public function __construct($filename, $embed = false)
    {

        if (is_string($filename)) {

            $this->filename = $filename;

        } else {

            user_error('You must provide a filename');

        }

        if ($embed) {

            $this->setEmbed();

        }

    }

    public function setEmbed()
    {

        $this->embed = true;

    }

    public function getEmbed()
    {

        return $this->embed;

    }

    public function process(WKPDF $wkpdf)
    {

        $wkpdf->render();
        $wkpdf->output($this->embed ? WKPDF::$PDF_EMBEDDED : WKPDF::$PDF_DOWNLOAD, $this->filename);

        return true;

    }

}
