<?php

/**
 * @file
 * {@inheritdoc}
 */

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/views/templates/');
$twig = new Environment($loader);
