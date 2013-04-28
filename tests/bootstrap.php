<?php

define('BASE_PATH', realpath(dirname(__DIR__)));

$filename = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($filename)) {
    echo 'You must first install the vendors using composer.' . PHP_EOL;
    exit(1);
}

$loader = require_once $filename;

$loader->add('Heyday', __DIR__);
$loader->addClassMap(Symfony\Component\ClassLoader\ClassMapGenerator::createMap(BASE_PATH . '/sapphire'));