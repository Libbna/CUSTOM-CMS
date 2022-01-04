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

    public function setUserToAdmin($user_id){
        // UPDATE userdetails SET bio = ? WHERE user_id = ?
        $query = $this->conn->prepare("UPDATE userauth SET roles = ? WHERE id = ?");
        $query->bind_param("si", $role, $user_id);
        $role = "admin";
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function setUserToAuth($user_id){
        $authenticated = "authenticated"; 
        $query = $this->conn->prepare("UPDATE userauth SET roles = ? WHERE id = ?");
        $query->bind_param("si", $role, $user_id);
        $role = $authenticated;

        // if logged in user who is also admin, requests to change the role.
        if ($_SESSION['user_id'] == $user_id){
            if ($_SESSION['role'] == 'admin'){
                $_SESSION['role'] = $authenticated;
            }
        }

        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    
}