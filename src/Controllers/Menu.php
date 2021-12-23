<?php
namespace Cms\Controllers;
use Cms\Models\Database;

class Menu
{

    public function getMenu($twig){
        $getMenuItems = new Database();
        $result = $getMenuItems->displayMenuTitle();
        // var_dump($result);
        echo $twig->render('layout.html.twig', ['result' => $result]);
        return;
    }
}