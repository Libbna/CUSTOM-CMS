<?php

namespace Cms\Models;

require "dbconfig.php";
class ArticleModel
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

    public function insertArticleData($title, $body, $user_id){
        $query = $this->conn->prepare("INSERT INTO articles(title, body, user_id) VALUES(?, ?, ?)");
        $query->bind_param("ssi", $title, $body, $user_id);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    
    public function getAllArticles(){
        $query = $this->conn->prepare("SELECT * FROM articles");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    

}
