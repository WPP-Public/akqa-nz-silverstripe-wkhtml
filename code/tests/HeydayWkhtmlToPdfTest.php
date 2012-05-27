<?php

class HeydayWkhtmlToPdfTest extends SapphireTest
{

	public function testRequestInput()
	{

		$request = new SS_HTTPRequest('GET', '/wkhtmltopdf/testcontent/');

		$controller = new HeydayWkHtmlToPdfController();

		$input = new HeydayWkHtmlToPdfRequestInput($request);

		$this->assertEquals($input->process(), $controller->testcontent());

	}

}
