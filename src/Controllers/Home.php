<?php

namespace Cms\Controllers;

session_start();

class Home extends ControllerBase

{
    public static function getData($twig)
    {
        $variables = parent::preprocesspage();
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
        }
        echo $twig->render('home.html.twig', $variables);
        return;
    }   
}

