# Silverstripe Wkhtml - by Heyday

[![Build Status](https://travis-ci.org/heyday/silverstripe-wkhtml.png?branch=master)](https://travis-ci.org/heyday/silverstripe-wkhtml)

This module provides a SilverStripe-centric wrapper for [Snappy](https://github.com/KnpLabs/snappy) and [wkhtml](http://code.google.com/p/wkhtmltopdf/).

A `SilverStripe 3` version is available as `^2.x`, and a SilverStripe `2.4` version is available as `^1.x`.

## Requirements

* [Composer](http://getcomposer.org/)
* [Wkhtml binary](http://code.google.com/p/wkhtmltopdf/downloads/list) either wkhtmltopdf or wkhtmltoimage

## Installation

    $ composer require "heyday/silverstripe-wkhtml:^3"

## How to use

Four things are required to generate a pdf or an image:

* `Knp\Snappy\GeneratorInterface` The wrapper for wkhtmltopdf or wkhtmltoimage
* `Heyday\SilverStripe\WkHtml\Input\InputInterface` to provide the html
* `Heyday\SilverStripe\WkHtml\Output\OutputInterface` output the pdf or image in different ways
* `Heyday\SilverStripe\WkHtml\Generator` to glue everything together

### Available Inputs

- Request (generates content from a request)
- TextString (content is specified by a string)
- Template (generates content from a SilverStripe template)
- Url (generates content from a GET request to a Url)
- Viewer (generates content from an SSViewer instance)

### Available Outputs

- Browser (outputs to the browser)
- File (outputs to a file)
- RandomFile (outputs to a random filename)
- TextString (outputs to a string)

### Available Generators

- Pdf
- Image

## Examples

### Full example (from a controller action)

```yaml
SilverStripe\Core\Injector\Injector:
  # Create PDF generator as an injector service
  # This allows you to specify the binary path once and have it set up
  # automatically by getting the service from the injector.
  Knp\Snappy\Pdf:
    constructor:
      - '/bin/wkhtmltopdf' # Path to your WKTHMLTOPDF binary. Use '`SOME_ENV_VAR`' to define the binary path in .env
```

```php
use Heyday\SilverStripe\WkHtml;
use SilverStripe\Core\Injector\Injector;

$generator = WkHtml\Generator::create(
    // Use Injector->get(Pdf::class) if you don't need to modify options
    // Use Injector->create() to create a transient service for modifications (e.g. setOption)
    // Using Injector->get() and making changes will cause changes to be made for all uses of get(Pdf::class) for the entire request
    Injector::inst()->create(\Knp\Snappy\Pdf::class),
    WkHtml\Input\Url::create('/'),
    WkHtml\Output\Browser::create('test.pdf', 'application/pdf')
);
return $generator->process();
```

### Inputs

#### Request

```php
\Heyday\SilverStripe\WkHtml\Input\Request::create(
    // Controller::curr()->getRequest() is also an option
    Injector::inst()->get(\SilverStripe\Control\HTTPRequest::class)
);
```

```php
\Heyday\SilverStripe\WkHtml\Input\Request::create(
    Injector::inst()->get(\SilverStripe\Control\HTTPRequest::class),
    new Session([
        'arg' => 'value',
    ])
);
```

#### String

```php
$html = <<<HTML
<h1>Title</h1>
HTML;
\Heyday\SilverStripe\WkHtml\Input\TextString::create($html);
```

#### Template

```php
\Heyday\SilverStripe\WkHtml\Input\Template::create('MyTemplate');

\Heyday\SilverStripe\WkHtml\Input\Template::create(
    'MyTemplate',
    [
        'Var' => 'Hello',
    ]
);

\Heyday\SilverStripe\WkHtml\Input\Template::create(
    'MyTemplate',
    ArrayData::create([
        'Var' => 'Hello',
    ])
);

\Heyday\SilverStripe\WkHtml\Input\Template::create(
    '$Var World',
    ArrayData::create([
        'Var' => 'Hello',
    ]),
    true
);
```

#### Viewer

```php
\Heyday\SilverStripe\WkHtml\Input\Viewer::create(
    SSViewer::create([
        'Template',
    ]),
    ArrayData::create([
        'Var' => 'Hello',
    ])
);
```

#### Url

```php
\Heyday\SilverStripe\WkHtml\Input\Url::create('/');

\Heyday\SilverStripe\WkHtml\Input\Url::create('http://google.co.nz/');
```

### Outputs

#### Browser

```php
\Heyday\SilverStripe\WkHtml\Output\Browser::create('test.pdf', 'application/pdf'); // Force download

\Heyday\SilverStripe\WkHtml\Output\Browser::create('test.pdf', 'application/pdf', true); // Embeds
```

#### File

```php
\Heyday\SilverStripe\WkHtml\Output\File::create(BASE_PATH . '/test.pdf');

\Heyday\SilverStripe\WkHtml\Output\File::create(BASE_PATH . '/test.pdf', true); // Overwrite
```

#### Random File

```php
\Heyday\SilverStripe\WkHtml\Output\RandomFile::create(BASE_PATH);
```

#### String

```php
\Heyday\SilverStripe\WkHtml\Output\TextString::create();
```

##Unit Testing
```bash
$ composer install
$ phpunit
```

## License

This project is licensed under an MIT license

