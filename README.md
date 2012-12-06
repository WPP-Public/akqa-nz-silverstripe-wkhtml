#Heyday silverstripe-wkhtmltopdf

This module provides a SilverStripe-centric wrapper for the [wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) project and php bindings.

##License

This project is licensed under an MIT license which can be found at `silverstripe-wkhtmlprof/LICENSE`

##Requirements

You will require a [wkhtmltopdf binary](http://code.google.com/p/wkhtmltopdf/downloads/list) to use heyday-wkhtmltopdf

##Installation
###Regular install
To install just drop the silverstripe-wkhtmltopdf directory into your SilverStripe root and run a ?flush=1

###Composer
Installing from composer is easy,

Create or edit a `composer.json` file in the root of your SilverStripe project, and make sure the following is present.

```json
{
    "require": {
        "heyday/silverstripe-wkhtmltopdf": "*"
    }
}
```
After completing this step, navigate in Terminal or similar to the SilverStripe root directory and run composer install or composer update depending on whether or not you have composer already in use.

##How to use

In heyday-wkhtmltopdf the main functionality is achieved through the idea of Inputters and Outputters. 

###Current inputters:

- SilverStripeWkHtmlToPdfRequestInput
- SilverStripeWkHtmlToPdfTemplateInput
- SilverStripeWkHtmlToPdfUrlInput
- SilverStripeWkHtmlToPdfStringInput

###Current outputters

- SilverStripeWkHtmlToPdfBrowserOutput
- SilverStripeWkHtmlToPdfFileOutput
- SilverStripeWkHtmlToPdfStringOutput

Inputters provide different methods of collecting HTML input for PDF generation.

Outputters provide different methods of outputting the rendered PDF file.

To successfully produce a PDF you must pass an inputter and an outputter into SilverStripeWkHtmlToPdf and then process.

##Examples

###Input from string template, Output to file with randomly generated name

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfTemplateInput(
			'<html><body><h1>Hello $Name</h1></body></html>',
			array('Name' => 'Tester'),
			true
		),
		new SilverStripeWkHtmlToPdfFileOutput(dirname(__FILE__) . '/../tests', true) 
	)->process();

###Input from string template, Output to specific file

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfTemplateInput(
			'<html><body><h1>Hello $Name</h1></body></html>',
			array('Name' => 'Tester'),
			true
		),
		new SilverStripeWkHtmlToPdfFileOutput(dirname(__FILE__) . '/../tests/Output.pdf') 
	)->process();

###Input from string template, Output to specific file overwriting any existing file

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfTemplateInput(
			'<html><body><h1>Hello $Name</h1></body></html>',
			array('Name' => 'Tester'),
			true
		),
		new SilverStripeWkHtmlToPdfFileOutput(dirname(__FILE__) . '/../tests/Output.pdf', false, true) 
	)->process();

###Input from template file, Output to browser

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfTemplateInput(
			'PdfTemplate',
			array('Name' => 'Tester')
		),
		new SilverStripeWkHtmlToPdfBrowserOutput('Output.pdf')
	)->process();

###Input from local silverstripe url, Output to browser

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfUrlInput(
			'/pdf-page/'
		),
		new SilverStripeWkHtmlToPdfBrowserOutput('Output.pdf')
	)->process();

###Input from external html page, Output to browser

	SilverStripeWkHtmlToPdf::get_instance(
		new SilverStripeWkHtmlToPdfUrlInput(
			'http://heyday.co.nz/'
		),
		new SilverStripeWkHtmlToPdfBrowserOutput('Output.pdf')
	)->process();

##Unit Testing

If you have `phpunit` installed you can run `silverstripe-wkhtmltopdf`'s unit tests to see if everything is functioning correctly.

###Running the unit tests

From the command line:
	
	./sake dev/tests/module/silverstripe-wkhtmltopdf

##Sources:

- [wkhtmltopdf](https://github.com/antialize/wkhtmltopdf)
- [wkhtmltopdf-bindings](https://github.com/antialize/wkhtmltopdf-bindings)

##Notes:

###OS X:

Installing on OS X on MAMP requires manually installing imagemagik.

An easy way to do this is to use homebrew

	brew install imagemagick

When this is done open

	/Applications/MAMP/Library/bin/envvars


Comment out:

	#DYLD_LIBRARY_PATH="/Applications/MAMP/Library/lib:$DYLD_LIBRARY_PATH"
	#export DYLD_LIBRARY_PATH

And add

	export PATH="$PATH:/opt/local/bin"

