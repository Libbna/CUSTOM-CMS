<?php
require 'vendor/autoload.php';

// require_once __DIR__.'/bootstrap.php';

use App\Controllers\Contacts;
use App\Controllers\Home;

require_once('./twigtemplate.php');


spl_autoload_register(function($className) {
  // $base_dir = __DIR__ . '/src/';

  // $file = $base_dir . str_replace('\\', '/', $className) . '.php';

  // if the file exists, require it
  // if (file_exists($file)) {
  //   require $file;
  // }

  include './controllers/' . $className . '.php';
});

// $ob1 = new Home();
// $ob2 = new Contacts();

// Sample data
$foo = [
  [ 'name'          => 'Alice' ],
  [ 'name'          => 'Bob' ],
  [ 'name'          => 'Eve' ],
];

// Render our view
echo $twig->render('home.html.twig', ['foo' => $foo] );