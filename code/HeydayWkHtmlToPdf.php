<?php

require_once __DIR__ . '/ThirdParty/wkhtmltopdf.php';

/**
 * HeydayWkHtmlToPdf provides a SilverStripe-centric wrapper for the [wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) project and php bindings.
 */
class HeydayWkHtmlToPdf
{

	/**
	 * Localtion of the wkhtmltopdf binary. This must be set to use this module.
	 */
	protected static $bin = false;

	/**
	 * The outputter to use.
	 */
	protected $outputter = false;
	/**
	 * The inputter to use
	 */
	protected $inputter = false;

	/**
	 * Convinience method for getting an instance of this class
	 */
	public static function get_instance( $input, $output )
	{

		return new self( $input, $output );

	}

	/**
	 * Set the binary for use in the module. This must be set to do any processing. This should be called from your config
	 */
	public static function set_bin( $bin )
	{

		self::$bin = $bin;

	}

	/**
	 * Get the binary location
	 */
	public static function get_bin()
	{

		return self::$bin;

	}

	/**
	 * Constructor. Create the class and set the input and output it exists.
	 */
	public function __construct( $input = null, $output = null )
	{

		if ($input instanceof HeydayWkHtmlToPdfInputter) {

			$this->setInputter( $input );

		}

		if ($output instanceof HeydayWkHtmlToPdfOutputter) {

			$this->setOutputter( $output );

		}

	}

	/**
	 * Sets the outputter ensuring it implements the interface
	 */
	public function setOutputter( HeydayWkHtmlToPdfOutputter $outputter )
	{

		$this->outputter = $outputter;

	}

	/**
	 * Sets the inputter ensuring it implements the interface
	 */
	public function setInputter( HeydayWkHtmlToPdfInputter $inputter )
	{

		$this->inputter = $inputter;

	}

	/**
	 * The almighty process method. This processes the pdf using the inputters and outputters that have been set.
	 */
	public function process()
	{

		if ( !$this->outputter || !$this->outputter instanceof HeydayWkHtmlToPdfOutputter ) {

			user_error( 'Need to have an outputter set in order to output the PDF' );

		}

		if ( !$this->inputter || !$this->inputter instanceof HeydayWkHtmlToPdfInputter ) {

			user_error( 'Need to have an inputter set in order to get the content for the PDF' );

		}

		$wkpdf = new WKPDF();

		//TODO do some special stuff with WKPDF if options are set

		if ( !self::$bin ) {

			user_error( 'wkhtmltopdf binary not set' );

		}

		$wkpdf->set_cmd( self::$bin );

		return $this->outputter->process( $wkpdf, $this->inputter );

	}

}

