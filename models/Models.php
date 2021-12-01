<?php
require "dbconfig.php";
class Database
{
    public $conn;
    public $result;
    public $sql;

    public function __construct()
    {
        require 'dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Datbase connection failed</h1>";
        }
    }

    public function fetchUserDetails()
    {
        $query = $this->conn->prepare("SELECT * FROM users");
        $query->execute();
        $ans = $query->get_result();
        // $ans = $res->fetch_assoc();
        return $ans;
    }

    public function insertUserDetails($name, $phone){
        $query = $this->conn->prepare("INSERT INTO users(name, phone) VALUES('$name', '$phone')");
        $query->execute();
        $ans = $query->get_result();
        // $ans = $res->fetch_assoc();
        return $ans;
    }
}
