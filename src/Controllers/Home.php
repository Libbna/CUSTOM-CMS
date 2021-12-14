<?php

namespace Cms\Controllers;

class Home

{
    public static function getData($twig)
    {
        $data = "Dummy";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }   
}

