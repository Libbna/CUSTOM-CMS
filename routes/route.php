<?php 
    require_once('../twigtemplate.php');
    $path = $_SERVER['REQUEST_URI'];

    switch ($path){
        case "/custom_cms/home":
            echo $twig->render('home.html.twig' , ['name' => "Raj"]);
            break;
        default:
            echo "Error 404";
    }

    