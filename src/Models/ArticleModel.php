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

    public function insertArticleData($title, $body, $user_id, $category){
        $query = $this->conn->prepare("INSERT INTO articles(title, body, user_id, category) VALUES(?, ?, ?, ?)");
        $query->bind_param("ssis", $title, $body, $user_id, $category);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    
    

}
