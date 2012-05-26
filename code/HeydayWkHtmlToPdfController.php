<?php

class HeydayWkHtmlToPdfController extends Controller
{

	static $url_segment = 'wkhtmltopdf';

	static $allowed_actions = array(
		'index',
		'test',
		'external'
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
			'sake wkhtmltopdf/test',
			'sake wkhtmltopdf/external'
		)), PHP_EOL;

		exit;

	}

	public function template_to_random_file()
	{

		HeydayWkHtmlToPdf::get_instance(
			new HeydayWkHtmlToPdfTemplateInput(
				'<html><body><h1>Hello $Name</h1></body></html>',
				array('Name' => 'Tester'),
				true
			),
			new HeydayWkHtmlToPdfFileOutput(dirname(__FILE__) . '/../tests', true)
		)->process();

		HeydayWkHtmlToPdf::get_instance(
			new HeydayWkHtmlToPdfTemplateInput(
				'<html><body><h1>Hello $Name</h1></body></html>',
				array('Name' => 'Tester'),
				true
			),
			new HeydayWkHtmlToPdfBrowserOutput('Output.pdf')
		)->process();

	}

	public function external()
	{

		HeydayWkHtmlToPdf::get_instance(
			new HeydayWkHtmlToPdfUrlInput(
				'http://lesswrong.com/lw/jg/planning_fallacy/'
			),
			new HeydayWkHtmlToPdfFileOutput(dirname(__FILE__) . '/../tests/lesswrong.pdf')
		)->process();

	}

}

