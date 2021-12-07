<?php
// require_once "vendor/autoload.php";

// require_once __DIR__.'/bootstrap.php';

// use CustomCms\Controllers\Contacts;
// use CustomCms\Controllers\Home; 
// use CustomCms\Routes;


// require_once('./twigtemplate.php');


// Sample data
// $foo = [
//   [ 'name'          => 'Alice' ],
//   [ 'name'          => 'Bob' ],
//   [ 'name'          => 'Eve' ],
// ];

// Render our view
// echo $twig->render('home.html.twig', ['foo' => $foo] );

// $home = new Home();
// $contact = new Contacts();


    // namespace CustomCms;

    // echo "libbna";
    // die();
    require_once "vendor/autoload.php";

    use \CustomCms\Controllers\Home;
    use CustomCms\Controllers\Contacts;

    require_once('./twigtemplate.php');
    
    // require_once('../controllers/Home.php');
    // require_once('../controllers/Contact.php');

    $url = $_SERVER['REQUEST_URI'];  
    $org_path = explode('/', $url);
    $path = $org_path[2];  
    switch ($path){
        case "home":
            $object = new Home();
            $response = $object->getData($twig);
            break;
        case "home?insert":
            $object = new Contacts();
            $object->insertUser($twig);
            break;
        case "contact":
            $object = new Contacts();
            $response = $object->fetchUser($twig);
            break;
        default:
            echo "Error 404";
    }

    
// $home = new Home();
// $contact = new Contacts();