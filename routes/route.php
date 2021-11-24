<?php 

    // echo "Hey You are here";
    $path = $_SERVER['REQUEST_URI'];
    echo $path;

    switch ($path){
        case "/custom_cms/home":
            header("Location: index.php");
            Home::CreateView();
            // echo "Home !";
            break;
        // default:
        //     echo "Error 404";
    }

    