<?php 
    require_once('../twigtemplate.php');
    require_once ('../controllers/Home.php');
    
    $path = $_SERVER['REQUEST_URI'];
    switch ($path){
        case "/custom_cms/home":
            $object = new Home();
            $response = $object->getData($twig);
            break;
        default:
            echo "Error 404";
    }

    