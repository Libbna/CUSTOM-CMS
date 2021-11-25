<?php
require "dbconfig.php";
class Database{ 
    function db_connect(){
        $con = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$con) {
            die("Connection to database failed");
        }
    }
}
class Contact{
    function fetchUserDetails($id){
        $sql = "SELECT * FROM users WHERE id = '$id' ";
        $result = mysqli_query($con, $sql);
        return $row = mysqli_fetch_assoc($result);
    }
}