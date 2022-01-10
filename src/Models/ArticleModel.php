<?php

namespace Cms\Models;

class ArticleModel
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



    public function insertArticleData($title, $body, $user_id, $category){

        $article_image = $_FILES['article_image'];

        $file = $article_image['name'];
        $file_tmp = $article_image['tmp_name'];

        $profile_ext = explode('.',  $file);
        $filecheck = strtolower(end($profile_ext));

        $file_ext_stored = array('jpeg', 'png', 'jpg');

        if (in_array($filecheck, $file_ext_stored)) {
            $destinationFile = 'assets/images/' . $file;
            move_uploaded_file($file_tmp, $destinationFile);
        }

        $query = $this->conn->prepare("INSERT INTO articles(title, body, user_id, category, image) VALUES(?, ?, ?, ?, ?)");
        $query->bind_param("ssiss", $title, $body, $user_id, $category, $destinationFile);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function fetchAllArticleData() {
        $query = $this->conn->prepare("SELECT * FROM articles");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }


    public function fetchTopicWiseArticles($category = "Food"){
        $query = $this->conn->prepare("SELECT * FROM articles WHERE category = ?");
        $query->bind_param("s", $category);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }


    public function fetchArticleById($blog_id){
        $query = $this->conn->prepare("SELECT * FROM articles WHERE id = ?");
        $query->bind_param("i", $blog_id);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function fetchRelatedArticles(){
        $query = $this->conn->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT ?");
        $query->bind_param("i", $count);
        $count = 3;
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function fetchCategoryList(){
        $query = $this->conn->prepare("SELECT DISTINCT category FROM articles LIMIT 5");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function fetchPopularPosts(){
        $query = $this->conn->prepare("SELECT * FROM articles ORDER BY id ASC LIMIT 3 ");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function deleteArticleById($id){
        $query = $this->conn->prepare("DELETE FROM articles WHERE id = ? ");
        $query->bind_param('i', $id);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

}
