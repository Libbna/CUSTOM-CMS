<?php
require_once('Controller.php');

class Contacts extends Controller
{
    public function __construct()
    {
        require_once __DIR__ . "../models/Models.php";
    }
    
    public function fetchUser($twig)
    {
        $contact = new Contact($this->db);
        $result = $contact->fetchUserDetails($_GET["id"]);
        echo $this->$twig->render('../views/contact.html.twig');
        return $result;
    }
}
