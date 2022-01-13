<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\Database;

class Menu extends ControllerBase
{
    public function displayMenuForm($twig){

        $variables = parent::preprocesspage();
        if (!isset($_SESSION["loggedin"])) {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        $variables['title'] = $this->reverie . " | Enter Menu";
        echo $twig->render('menu.html.twig', $variables);
        return;
    }

    public function insertCustomMenu($twig){

        $variables = parent::preprocesspage();
        $menu_title = $_POST['menu-title'];
        $menu_link = $_POST['menu-link'];

        if (!isset($menu_title) and !isset($menu_link)){
            echo $twig->render('error.html.twig');
            return;
        }

        $newMenu = new Database();
        $result = $newMenu->insertMenuDetails($menu_title, $menu_link);
        $variables['result'] = $result; 
        $variables['role'] = $_SESSION['role'];
        $variables['title'] = $this->reverie . " | Menu";
        $baseUrl = $variables['base_url'];
        $variables['status'] = "true";
        $variables['message'] = '"' . $menu_title . '" Menu Created Successfully!';
        header("Location:".$baseUrl."menu-form");
        echo $twig->render('menu.html.twig', $variables);
        return;
    }

    public function displayCustomMenu($twig){

        $variables = parent::preprocesspage();
        if (!isset($_SESSION["loggedin"])) {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        $displayMenuList = new Database();
        $result = $displayMenuList->displayMenu();
        $variables['result'] = $result;
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        $variables['title'] = $this->reverie . " | Menus";
        echo $twig->render('menuDisplay.html.twig', $variables);
        return;
    }
}