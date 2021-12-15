<?php
namespace Cms\Controllers;

class CustomBlock
{
    public function displayForm($twig){
        echo $twig->render('block.html.twig');
        return;
    }

    public function customBlockInfo($twig){

        $block_title = $_POST['block-title'];
        $block_body = $_POST['block-description'];

        if (!isset($block_title) and !isset($block_body)){
            echo $twig->render('error.html.twig');
            return;
        }

        echo $twig->render('blockDisplay.html.twig');
        return;
    }
}