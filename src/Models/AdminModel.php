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
    public function deleteUser($id){
        $query = $this->conn->prepare("DELETE FROM userauth WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return;
    }

    public function insertLogo() {
        $logo = $_FILES['logo_upload'];
        $file = $logo['name'];
        $file_tmp = $logo['tmp_name'];

        $profile_ext = explode('.',  $file);
        $filecheck = strtolower(end($profile_ext));

        $file_ext_stored = array('jpeg', 'png', 'jpg');

        if (in_array($filecheck, $file_ext_stored)) {
            $destinationFile = 'assets/images/' . $file;
            move_uploaded_file($file_tmp, $destinationFile);
        }
        $query = $this->conn->prepare("INSERT INTO config(logo) VALUES(?)");
        $query->bind_param("s", $destinationFile);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
}