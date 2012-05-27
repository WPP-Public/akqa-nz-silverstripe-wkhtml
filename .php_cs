<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->name('*.php')
    ->exclude(array(
        'code/ThirdParty'
    ))
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    ->fixers(array(
    	'unused_use',
    	'visibility',
    	'elseif',
    	'linefeed',
    	'trailing_spaces',
    	'return',
    	'short_tag',
    	'extra_empty_lines',
    	'phpdoc_params',
    	'eof_ending',
    	'braces',
    	'controls_spaces',
    	'elseif'
    ))
    ->finder($finder);