<?php

namespace Libbna\CustomCms\Controllers;

// use App\Models\Database;


// require_once('Controller.php');

class Home extends Controller
{
    public function getData($twig)
    {
        $data = "Dummy";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }   
}

