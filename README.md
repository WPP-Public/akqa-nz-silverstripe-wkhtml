# Heyday silverstripe-wkhtml

This module provides a SilverStripe-centric wrapper for the [wkhtml](http://code.google.com/p/wkhtml/) project.

## License

This project is licensed under an MIT license which can be found at `silverstripe-wkhtml/LICENSE`

## Requirements

You will require a [wkhtml binary](http://code.google.com/p/wkhtml/downloads/list) to use silverstripe-wkhtml

## Installation

    $ composer require heyday/silverstripe-wkhtml


## How to use

In silverstripe-wkhtml the main functionality is achieved through the idea of Inputs and Outputs.

### Current inputs:

- Request
- String
- Template
- Url

### Current outputs:

- Browser
- File
- RandomFile
- String

Inputs provide different methods of collecting HTML input for PDF or image generation.

Outputs provide different methods of outputting the rendered PDF or image file.

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

