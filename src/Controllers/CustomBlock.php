<?php
namespace Cms\Controllers;

session_start();

use Cms\Models\Database;

class CustomBlock extends ControllerBase
{
    public function displayForm($twig){

        $variables = parent::preprocesspage();
        if (!isset($_SESSION["loggedin"])) {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        $variables['username'] = $_SESSION['username'];
        $variables['role'] = $_SESSION['role'];
        $variables['authenticated_userId'] = $_SESSION['user_id'];
        $variables['title'] = $this->reverie . " | Block";
        echo $twig->render('block.html.twig', $variables);
        return;
    }

    public function insertCustomBlock($twig){

        $variables = parent::preprocesspage();
        $block_title = $_POST['block-title'];
        $block_body = $_POST['block-description'];

        if (empty($block_title) || empty($block_body)){
            $variables['message'] = "Enter all the details";
            echo $twig->render('error.html.twig', $variables);
            return;
        }

        $newBlock = new Database();
        $result = $newBlock->insertBlockDetails($block_title, $block_body);
        $variables['result'] = $result;
        $variables['authenticated_userId'] = $_SESSION['user_id'];
        $variables['title'] = $this->reverie . " | Block";
        $baseUrl = $variables['base_url'];
        header("Location:".$baseUrl."block-form");
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
        $variables['title'] = $this->reverie . " | Blocks";
        echo $twig->render('blockDisplay.html.twig', $variables);
        return;
    }
}