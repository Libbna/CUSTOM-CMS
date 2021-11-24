<?php
require_once('Controller.php');

class Home extends Controller
{
    public function __construct()
    {
        require_once __DIR__ . "../models/Models.php";
        
    }
    public function getData($twig)
    {
        $data = "Dummy Text";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }   
}

