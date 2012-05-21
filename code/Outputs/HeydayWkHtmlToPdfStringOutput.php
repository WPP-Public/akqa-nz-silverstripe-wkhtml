<?php

class HeydayWkHtmlToPdf implements HeydayWkHtmlToPdfOutputter
{

	public function process(WKPDF $wkpdf, HeydayWkHtmlToPdfInputter $inputter)
	{

		$wkpdf->set_html($inputter->process());
		$wkpdf->render();
		return $wkpdf->output(WKPDF::$PDF_ASSTRING, false);

	}
	
}