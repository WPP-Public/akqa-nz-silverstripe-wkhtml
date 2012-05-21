<?php

require_once dirname(__FILE__) . '/ThirdParty/wkhtmltopdf.php';

class HeydayWkHtmlToPdf
{

	protected static $bin = false;

	protected $outputter = false;
	protected $inputter = false;

	public static function get_instance($input, $output)
	{

		return new HeydayWkHtmlToPdf($input, $output);

	}

	public static function set_bin($bin)
	{

		self::$bin = $bin;

	}

	public static function get_bin()
	{

		return self::$bin;

	}

	public function __construct($input = null, $output = null)
	{

		if ($input instanceof HeydayWkHtmlToPdfInputter) {

			$this->setInputter($input);

		}

		if ($output instanceof HeydayWkHtmlToPdfOutputter) {

			$this->setOutputter($output);

		}

	}

	public function setOutputter(HeydayWkHtmlToPdfOutputter $outputter)
	{

		$this->outputter = $outputter;

	}

	public function setInputter(HeydayWkHtmlToPdfInputter $inputter)
	{

		$this->inputter = $inputter;

	}

	public function process()
	{

		if (!$this->outputter || !$this->outputter instanceof HeydayWkHtmlToPdfOutputter) {

			user_error('Need to have an outputter set in order to output the PDF');

		}

		if (!$this->inputter || !$this->inputter instanceof HeydayWkHtmlToPdfInputter) {

			user_error('Need to have an inputter set in order to get the content for the PDF');

		}

		//do some special stuff with WKPDF if options are set


		$wkpdf = new WKPDF();

		if (!self::$bin) {

			user_error('wkhtmltopdf binary not set');

		}

		$wkpdf->set_cmd(self::$bin);

		return $this->outputter->process($wkpdf, $this->inputter);

	}

}


