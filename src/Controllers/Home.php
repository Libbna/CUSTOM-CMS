<?php

namespace Cms\Controllers;

session_start();

class Home extends ControllerBase

{
    public static function getData($twig)
    {
        $variables = parent::preprocesspage();
        echo $twig->render('home.html.twig', $variables);
        return;
    }   
}

