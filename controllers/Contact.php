<?php
require_once('Controller.php');
require_once('../models/Models.php');

class Contacts extends Controller
{
    public function fetchUser($twig)
    {
        $contact = new Database();
        $result = $contact->fetchUserDetails();
        echo $twig->render('contact.html.twig', ["result" => $result]);
    }
}
