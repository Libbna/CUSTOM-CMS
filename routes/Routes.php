<?php 
    require_once('../twigtemplate.php');
    require_once ('../controllers/Home.php');
    require_once('../controllers/Contact.php');

    
    $url = $_SERVER['REQUEST_URI'];  
    $path = explode('/', $url)[0];
    // $path = $org_path[2];  
    switch ($path){
        case "/home":
            $object = new Home();
            $response = $object->getData($twig);
            // $twig->render('contact.html.twig');
            break;
        case "/contact":
            $object = new Contacts();
            $response = $object->fetchUser($twig);
            break;
        default:
            echo "Error 404";
    }


    // Route::set('home', function() {
    //     echo "homepage";
    // });