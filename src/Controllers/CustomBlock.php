<?php
namespace Cms\Controllers;

class CustomBlock
{
    public function displayForm($twig){
        echo $twig->render('block.html.twig');
        return;
    }

    public function customBlockInfo($twig){
        echo $twig->render('blockDisplay.html.twig');
        return;
    }
}