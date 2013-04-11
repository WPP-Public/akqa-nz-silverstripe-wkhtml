<?php

class HeydayWkhtmlToPdfTest extends SapphireTest
{

    public function testRequestInput()
    {

        $request = new SS_HTTPRequest('GET', '/wkhtmltopdf/testcontent/');

        $input = new HeydayWkHtmlToPdfRequestInput($request);

        $controller = new HeydayWkHtmlToPdfController();

        $this->assertEquals($input->process(), $controller->testcontent());

        $session = new Session(array('Hello' => 'Something'));

        $input = new HeydayWkHtmlToPdfRequestInput($request, $session);

        $this->assertEquals($input->getSession(), $session);
        $this->assertEquals($input->getRequest(), $request);

        $session = array('Hey' => 'Sessions');

        $input = new HeydayWkHtmlToPdfRequestInput($request, $session);

        $this->assertEquals($input->getSession(), new Session($session));

        $input = new HeydayWkHtmlToPdfRequestInput($request);

        $this->assertEquals($input->getSession(), new Session(null));

    }

    public function testStringInput()
    {

        $content = 'test content';

        $input = new HeydayWkHtmlToPdfStringInput($content);

        $this->assertEquals($input->process(), $content);

        $input = new HeydayWkHtmlToPdfStringInput();

        $input->setString($content);

        $this->assertEquals($input->process(), $content);
        $this->assertEquals($input->getString(), $content);

    }

    public function testTemplateInput()
    {

        $input = new HeydayWkHtmlToPdfTemplateInput('HeydayWkHtmlToPdfTemplateInput', array('Name' => 'Something'));

        $this->assertEquals($input->process(), 'Some content Something');

        $input = new HeydayWkHtmlToPdfTemplateInput('Something $Name', array('Name' => 'Something'), true);

        $this->assertEquals($input->process(), 'Something Something');

        $input = new HeydayWkHtmlToPdfTemplateInput('Something', false, true);

        $this->assertEquals($input->process(), 'Something');

        $input = new HeydayWkHtmlToPdfTemplateInput('Something');

        $this->assertEquals($input->getTemplate(), 'Something');

        $input = new HeydayWkHtmlToPdfTemplateInput('HeydayWkHtmlToPdfTemplateInput', new ArrayData(array('Name' => 'Something')));

        $this->assertEquals($input->process(), 'Some content Something');

        $input = new HeydayWkHtmlToPdfTemplateInput('HeydayWkHtmlToPdfTemplateInput');

        $this->assertEquals($input->process(array('Name' => 'Something')), 'Some content Something');

    }

    public function testUrlInput()
    {

        $input = new HeydayWkHtmlToPdfUrlInput('/wkhtmltopdf/testcontent/');

        $controller = new HeydayWkHtmlToPdfController();

        $this->assertEquals($input->process(), $controller->testcontent());

        $input = new HeydayWkHtmlToPdfUrlInput('http://heyday.co.nz/');

        $this->assertEquals($input->process(), file_get_contents('http://heyday.co.nz/'));

    }

    public function testBrowserOutput()
    {

    }

}
