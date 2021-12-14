<?php

use Cms\Controllers\Contact;
use Cms\Controllers\Home;

// require_once("vendor/autoload.php");


require_once('./twigtemplate.php');

// Sample data
$foo = [
  [ 'name'          => 'Alice' ],
  [ 'name'          => 'Bob' ],
  [ 'name'          => 'Eve' ],
];

// // Render our view
echo $twig->render('home.html.twig', ['foo' => $foo] );

    

    
    // $url = $_SERVER['REQUEST_URI'];  
    // $org_path = explode('/', $url);
    // $path = $org_path[2];  
    // switch ($path){
    //     case "home":
    //         $object = new Home();
    //         $response = $object->getData($twig);
    //         break;
    //     case "home?insert":
    //         $object = new Contact();
    //         $object->insertUser($twig);
    //         break;
    //     case "contact":
    //         $object = new Contact();
    //         // $response = $object->fetchUser($twig);
    //         break;
    //     default:
    //         echo "Error 404";
    // }


    
