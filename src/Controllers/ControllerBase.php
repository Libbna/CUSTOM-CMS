<?php

namespace Cms\Controllers;

use Cms\Models\Database;

class ControllerBase{
    protected $page = [];
    protected $reverie = "Reverie";
    protected function preprocessPage(){

        $this->page['nav_links'] = $this->getNavLinks();
        $this->page['base_url'] = $this->getBaseUrl();
        return $this->page;
    }
    protected function getNavLinks(){

        $displayMenu = new Database();
        $result = $displayMenu->displayMenu();
        return $result;

    }
    protected function getBaseUrl(){
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $base = explode("route", $url);
        return $base[0];
    }
} 