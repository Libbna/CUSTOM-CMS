<?php

namespace Cms\Controllers;

use Cms\Models\Database;

class Home

{
    public static function getData($twig)
    {
        $data = "Dummy";
        echo $twig->render('home.html.twig', ['name' => $data]);

        $displayMenu = new Database();
        $result = $displayMenu->displayMenu();
        echo $twig->render('header.html.twig', ['result' => $result]);
        return;
    }   
}

