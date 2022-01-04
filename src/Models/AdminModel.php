<?php

namespace Cms\Models;

class AdminModel
{
    public $conn;
    public $result;
    public $sql;
    
    //establishing database connection
    public function __construct()
    {
        require './dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Datbase connection failed</h1>";
            return;
        }
    }

    // query for displaying Users 
    public function displayUsers() {
        $query = $this->conn->prepare("SELECT * FROM userauth");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function deleteUser($id){
        $query = $this->conn->prepare("DELETE FROM userauth WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return;
    }
    
}