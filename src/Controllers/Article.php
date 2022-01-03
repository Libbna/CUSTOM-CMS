<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\ArticleModel;

class Article extends ControllerBase
{


    public function getArticleForm($twig)
    {
        $variables = parent::preprocesspage();
        if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != true) {
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        $variables['role'] = $_SESSION['role'];
        echo $twig->render("articleForm.html.twig", $variables);
        return;
    }

    public function insertArticle($twig)
    {
        $variables = parent::preprocesspage();
        if (!isset($_POST['article-title']) and !isset($_POST['article-body']) and !isset($_POST['article-category'])){
            $variables['message'] = "Enter all the article details!";
            echo $twig->render("error.html.twig", $variables);
            return;
        } 

        $article_title = $_POST['article-title'];
        $article_body = strip_tags($_POST['article-description']);
        $article_category = $_POST['article-category'];
        $article_image = $_POST['article_image'];

        $contact = new ArticleModel();
        $ans = $contact->insertArticleData($article_title, $article_body, $_SESSION['user_id'], $article_category, $article_image);

        if (empty($ans) == 1){
            $variables['status'] = "true";
            $variables['message'] = "Article posted successfully!";
            $variables['role'] = $_SESSION['role'];
            echo $twig->render("articleForm.html.twig", $variables);
            return;
        }
        return;

    }
    
    public function fetchAllArticles($twig){

        $variables = parent::preprocesspage();
        $articles = new ArticleModel();
        $result = $articles->fetchAllArticleData();
        $variables['result'] = $result;
        if (isset($_SESSION["user_id"])){
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        echo $twig->render("home.html.twig", $variables);
    }


}
