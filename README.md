# Silverstripe Wkhtml - by Heyday

This module provides a SilverStripe-centric wrapper for [Snappy](https://github.com/KnpLabs/snappy) and [wkhtml](http://code.google.com/p/wkhtml/).

## Requirements

* [Composer](http://getcomposer.org/)
* [Wkhtml binary](http://code.google.com/p/wkhtml/downloads/list) either wkhtmltopdf or wkhtmltoimage

## Installation

    $ composer require heyday/silverstripe-wkhtml:dev-master

## How to use

Four things are required to generate a pdf or an image:

* `Knp\Snappy\GeneratorInterface` The wrapper for wkhtmltopdf or wkhtmltoimage
* `Heyday\SilverStripe\WkHtml\Input\InputInterface` to provide the html
* `Heyday\SilverStripe\WkHtml\Output\OutputInterface` output the pdf or image in different ways
* `Heyday\SilverStripe\WkHtml\Generator` to glue everything together

### Available Inputs

- Request
- String
- Template
- Url

### Available Outputs

- Browser
- File
- RandomFile
- String

### Available Generators

- Pdf
- Image

## Examples

### Full example

```php
return (new \Heyday\SilverStripe\WkHtml\Generator(
    new \Knp\Snappy\Pdf('/pathto/wkhtmltopdf'),
    new \Heyday\SilverStripe\WkHtml\Input\Request(
        new SS_HTTPRequest('GET', '/')
    ),
    new \Heyday\SilverStripe\WkHtml\Output\Browser('test.pdf', 'application/pdf', true)
))->process();
```

### Inputs

#### Request

```php
new \Heyday\SilverStripe\WkHtml\Input\Request(
    new SS_HTTPRequest('GET', '/')
);
```

```php
new \Heyday\SilverStripe\WkHtml\Input\Request(
    new SS_HTTPRequest('GET', '/'),
    new Session(
        array(
            'arg' => 'value'
        )
    )
);
```

#### String

```php
new \Heyday\SilverStripe\WkHtml\Input\String(
    <<<HTML
<h1>Title</h1>
HTML
);
```

#### Template

```php
new \Heyday\SilverStripe\WkHtml\Input\Template(
    'MyTemplate'
);
```

```php
new \Heyday\SilverStripe\WkHtml\Input\Template(
    'MyTemplate',
    array(
        'Var' => 'Hello'
    )
);
```

```php
new \Heyday\SilverStripe\WkHtml\Input\Template(
    'MyTemplate',
    new ArrayData(
        array(
            'Var' => 'Hello'
        )
    )
);
```

```php
new \Heyday\SilverStripe\WkHtml\Input\Template(
    '$Var World',
    new ArrayData(
        array(
            'Var' => 'Hello'
        )
    ),
    true
);
```

#### Url

```php
new \Heyday\SilverStripe\WkHtml\Input\Url('/');
```

```php
new \Heyday\SilverStripe\WkHtml\Input\Url('http://google.co.nz/');
```

### Outputs

#### Browser

```php
new \Heyday\SilverStripe\WkHtml\Output\Browser('test.pdf', 'application/pdf'); // Force download
```

```php
new \Heyday\SilverStripe\WkHtml\Output\Browser('test.pdf', 'application/pdf', true); // Embeds
```

#### File

```php
new \Heyday\SilverStripe\WkHtml\Output\File(BASE_PATH . '/test.pdf');
```

```php
new \Heyday\SilverStripe\WkHtml\Output\File(BASE_PATH . '/test.pdf', true); // Overwrite
```

#### Random File

```php
new \Heyday\SilverStripe\WkHtml\Output\RandomFile(BASE_PATH);
```

#### String

```php
new \Heyday\SilverStripe\WkHtml\Output\String();
```

##Unit Testing

    $ composer install --dev
    $ phpunit

## License

This project is licensed under an MIT license

