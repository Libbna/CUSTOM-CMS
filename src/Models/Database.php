<?php

namespace Cms\Models;
session_start();

require "dbconfig.php";
class Database
{
    public $conn;
    public $result;
    public $sql;

    //establishing database connection
    public function __construct()
    {
        require 'dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Datbase connection failed</h1>";
            return;
        }
    }
    
    //fetch user data from the database
    public function fetchUserDetails()
    {
        $query = $this->conn->prepare("SELECT * FROM users");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }


    public function insertUserDetails($name, $phone){
        $query = $this->conn->prepare("INSERT INTO users(name, phone) VALUES(?, ?)");
        $query->bind_param("ss", $name, $phone);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    // query for inserting block 
    public function insertBlockDetails($title, $desc){
        $query = $this->conn->prepare("INSERT INTO customBlock(block_title, block_desc) VALUES(?, ?)");
        $query->bind_param("ss", $title, $desc);
        $query->execute();
        $result = $query->get_result();
        return $result;
    }
    
    // query for displaying block 
    public function displayBlock() {
        $query = $this->conn->prepare("SELECT * FROM customBlock");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

}
