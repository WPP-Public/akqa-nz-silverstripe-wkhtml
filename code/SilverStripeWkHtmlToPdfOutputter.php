<?php

/**
 * Outputter interface
 */
interface SilverStripeWkHtmlToPdfOutputter
{

    /**
     * @param WKPDF $wkpdf
     * @return mixed
     */
    public function process(WKPDF $wkpdf);

}
