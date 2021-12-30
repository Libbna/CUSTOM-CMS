<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\Database;

class Menu extends ControllerBase
{
    public function displayMenuForm($twig){

        $variables = parent::preprocesspage();
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
        echo $twig->render('menu.html.twig', $variables);
        return;
    }

    public function displayCustomMenu($twig){

        $variables = parent::preprocesspage();
        $displayMenuList = new Database();
        $result = $displayMenuList->displayMenu();
        $variables['result'] = $result;
        echo $twig->render('menuDisplay.html.twig', $variables);
        return;
    }
}