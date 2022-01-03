<?php

namespace Cms\Controllers;

use Cms\Models\Database;

class ControllerBase{
    protected $page = [];
    protected $reverie = "Reverie";
    protected function preprocessPage(){

        $this->page['nav_links'] = $this->getNavLinks();
        return $this->page;
    }
    protected function getNavLinks(){

        $displayMenu = new Database();
        $result = $displayMenu->displayMenu();
        return $result;

    }
} 