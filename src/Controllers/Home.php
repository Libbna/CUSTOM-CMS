<?php

namespace Cms\Controllers;
session_start();
class Home

{
    public static function getData($twig)
    {
        $data = "Dummy";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }   
}

