<?php

// require_once __DIR__.'/bootstrap.php';
require_once('./twigtemplate.php');
require_once('./routes/Routes.php');

function __autoload($className) {
  if (file_exists('./classes/'.$className.'.php')) {
    require_once './classes/' . $className . '.php';
  } else if(file_exists('./controllers/' . $className . '.php')) {
    require_once './controllers/' . $className . '.php';
  }
}

// Sample data
$foo = [
  [ 'name'          => 'Alice' ],
  [ 'name'          => 'Bob' ],
  [ 'name'          => 'Eve' ],
];

// Render our view
echo $twig->render('home.html.twig', ['foo' => $foo] );