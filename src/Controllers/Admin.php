<?php
namespace Cms\Controllers;

session_start();

use Cms\Models\AdminModel;

class Admin extends ControllerBase
{

    public function displayUserDetails($twig){

        $variables = parent::preprocesspage();
        $displayUsers = new AdminModel();
        $result = $displayUsers->displayUsers();
        $variables['result'] = $result;
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        echo $twig->render('userDisplay.html.twig', $variables);
        return;
    }
}