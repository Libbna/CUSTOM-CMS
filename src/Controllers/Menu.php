<?php

namespace Cms\Controllers;

use Cms\Models\Database;

class Menu
{

    public function displayMenuForm($twig){

        echo $twig->render('menu.html.twig');
        return;
    }
    public function displayMenus($twig){
        $menuDisplay = new Database();
        $result = $menuDisplay->displayMenu();
        echo $twig->render('menuDisplay.html.twig', ['result' => $result]);
        return;
    }
    public function insertMenu($twig){
        $title = $_POST['menu-title'];
        $desc = $_POST['menu-link'];

        if (!isset($title) and !isset($desc)){
            echo $twig->render('error.html.twig');
            return;
        }

        $newMenu = new Database();
        $result = $newMenu->insertMenuDetails($title, $desc);
        echo $twig->render('menu.html.twig');
        return;
    }
}