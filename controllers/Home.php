<?php
require_once('Controller.php');
class Home extends Controller
{
    public function getData($twig)
    {
        $data = "Dummy Text";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }
}

