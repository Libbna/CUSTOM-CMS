<?php

namespace Cms\Controllers;

class Test {
    public function hello() {
        return "hello";
    }

    public function getData($twig)
    {
        $data = "Dummy";
        echo $twig->render('home.html.twig', ['name' => $data]);
        return;
    }   
}