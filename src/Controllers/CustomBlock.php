<?php
namespace Cms\Controllers;

session_start();

use Cms\Models\Database;

class CustomBlock extends ControllerBase
{
    public function displayForm($twig){

        $variables = parent::preprocesspage();
        $variables['username'] = $_SESSION['username'];
        $variables['role'] = $_SESSION['role'];
        echo $twig->render('block.html.twig', $variables);
        return;
    }

    public function insertCustomBlock($twig){

        $variables = parent::preprocesspage();
        $block_title = $_POST['block-title'];
        $block_body = strip_tags($_POST['block-description']);

        if (!isset($block_title) and !isset($block_body)){
            echo $twig->render('error.html.twig');
            return;
        }

        $newBlock = new Database();
        $result = $newBlock->insertBlockDetails($block_title, $block_body);
        $variables['result'] = $result;
        echo $twig->render('block.html.twig');
        return;
    }

    public function displayCustomBlock($twig){
        $variables = parent::preprocesspage();
        $displayBlockList = new Database();
        $result = $displayBlockList->displayBlock();
        $variables['result'] = $result;
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        echo $twig->render('blockDisplay.html.twig', $variables);
        return;
    }
}