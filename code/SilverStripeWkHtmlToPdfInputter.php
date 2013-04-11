<?php

/**
 * Inputter interface
 */
interface SilverStripeWkHtmlToPdfInputter
{

    /**
     * @param WKPDF $wkpdf
     * @return mixed
     */
    public function process(WKPDF $wkpdf);

}
