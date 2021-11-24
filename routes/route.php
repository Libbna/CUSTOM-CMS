<?php 

    require_once('../twigtemplate.php');

    // echo "Hey You are here";
    $path = $_SERVER['REQUEST_URI'];
    echo $path;

    switch ($path){
        case "/custom_cms/home":
            // header("Location: index.php");
            // Home::CreateView();
            // echo "Home !";
            echo $twig->render('home.html.twig' , ['name' => "Raj"]);
            break;
        // default:
        //     echo "Error 404";
    }

    