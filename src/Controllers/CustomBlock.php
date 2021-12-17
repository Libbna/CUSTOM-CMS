<?php
namespace Cms\Controllers;

use Cms\Models\Database;

class CustomBlock
{
    public function displayForm($twig){

        echo $twig->render('block.html.twig');
        return;
    }

    public function insertCustomBlock($twig){

        $block_title = $_POST['block-title'];
        $block_body = strip_tags($_POST['block-description']);

        if (!isset($block_title) and !isset($block_body)){
            echo $twig->render('error.html.twig');
            return;
        }

        $newBlock = new Database();
        $result = $newBlock->insertBlockDetails($block_title, $block_body);

        echo $twig->render('block.html.twig');
        return;
    }

    public function displayCustomBlock($twig){

        $displayBlockList = new Database();
        $result = $displayBlockList->displayBlock();

        echo $twig->render('blockDisplay.html.twig', ['result' => $result]);
        return;
    }
}