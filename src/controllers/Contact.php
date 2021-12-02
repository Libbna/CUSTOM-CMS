<?php

namespace CustomCms\Controllers;

use CustomCms\Models\Database;

// require_once('Controller.php');
// require_once('../models/Models.php');


class Contacts extends Controller
{
    public function fetchUser($twig)
    {
        $contact = new Database();
        $result = $contact->fetchUserDetails();
        echo $twig->render('contact.html.twig', ["result" => $result]);
    }

    public function insertUser($twig){
        
        if (!isset($_POST['userName']) and !isset($_POST['userPhone'])){
            echo $twig->render('error500.html.twig');
        }

        $name = $_POST['userName'];
        $phone = $_POST['userPhone'];

        $contact = new Database();
        $ans = $contact->insertUserDetails($name, $phone);
        $result = $contact->fetchUserDetails();
        echo $twig->render('contact.html.twig', ['result' => $result]);
        exit;

    }
}
