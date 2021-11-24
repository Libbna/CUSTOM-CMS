<?php

// require_once __DIR__.'/bootstrap.php';
require_once('./twigtemplate.php');

// Sample data
$foo = [
  [ 'name'          => 'Alice' ],
  [ 'name'          => 'Bob' ],
  [ 'name'          => 'Eve' ],
];

// Render our view
echo $twig->render('home.html.twig', ['foo' => $foo] );