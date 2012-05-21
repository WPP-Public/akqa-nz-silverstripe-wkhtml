<?php

class HeydayWkHtmlToPdfBrowserOutput implements HeydayWkHtmlToPdfOutputter
{

	public function __construct($filename)
	{

		if (is_string($filename)) {

			$this->filename = $filename; 

		} else {

			user_error('You must provide a filename');

		}

	}

	public function process(WKPDF $wkpdf, HeydayWkHtmlToPdfInputter $inputter)
	{

		$wkpdf->set_html($inputter->process());
		$wkpdf->render();
		$wkpdf->output(WKPDF::$PDF_EMBEDDED, $this->filename);

	}

}