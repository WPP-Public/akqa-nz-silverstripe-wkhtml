<?php

/**
 * Provies content output for unit tests.
 */
class HeydayWkHtmlToPdfController extends Controller
{

	static $url_segment = 'wkhtmltopdf';

	static $allowed_actions = array(
		'index',
		'testcontent'
	);

	public function init()
	{

		if (!Director::is_cli() && !Permission::check('ADMIN')) {

			user_error('No access allowed');
			exit;

		}

		parent::init();

	}

	public function index()
	{

		echo implode(PHP_EOL, array(
			'Commands available:',
		)), PHP_EOL;

		exit;

	}

	public function testcontent()
	{

		return '<html><body><h1>Test</h1></body></html>';

	}

}

