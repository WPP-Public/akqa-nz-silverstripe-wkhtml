<?php

interface HeydayWkHtmlToPdfOutputter
{

	public function process(WKPDF $wkpdf, HeydayWkHtmlToPdfInputter $input);

}