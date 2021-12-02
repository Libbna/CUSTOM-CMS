<?php
require_once "./vendor/autoload.php";

// require_once __DIR__.'/bootstrap.php';

use CustomCms\Controllers\Contacts;
use CustomCms\Controllers\Home;
use CustomCms\Routes;

require_once('./twigtemplate.php');

// $home = new Home();

// Sample data
$foo = [
  [ 'name'          => 'Alice' ],
  [ 'name'          => 'Bob' ],
  [ 'name'          => 'Eve' ],
];

// Render our view
echo $twig->render('home.html.twig', ['foo' => $foo] );