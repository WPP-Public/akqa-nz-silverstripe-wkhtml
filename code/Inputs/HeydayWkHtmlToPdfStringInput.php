<?php

class HeydayWkHtmlToPdfStringInput implements HeydayWkHtmlToPdfInputter
{

	protected $string = false;

	public function __construct($string = false)
	{

		if ($string) {

			$this->setString($string);

		}

	}

	public function setString($string)
	{

		$this->string = $string;

	}

	public function getString()
	{

		return $this->string;

	}

	public function process(WKPDF $wkpdf)
	{

		$wkpdf->set_html($this->string);

	}

}
