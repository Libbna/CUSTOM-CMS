<?php

class Controller {
    protected $db;

    public function __construct()
    {
        require_once __DIR__ . "../models/Models.php";

        $this->$db = new Database;
    }
    public static function CreateView() {
        echo "View Created";
    }
}
