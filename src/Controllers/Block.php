<?php
namespace Cms\Controllers;

class Block
{
    public function displayForm($twig){
        echo $twig->render('block.html.twig');
        return;
    }
}