<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\ArticleModel;

class Article
{


    public function getArticleForm($twig)
    {
        if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != true) {
            echo $twig->render("error.html.twig", ["message" => "Access Prohibited!"]);
            return;
        }

        echo $twig->render("articleForm.html.twig");
        return;
    }

    public function insertArticle($twig)
    {
        if (!isset($_POST['article-title']) and !isset($_POST['article-body'])) {
            echo $twig->render("error.html.twig", ["message" => "Enter all the article details!"]);
            return;
        } 

        $article_title = $_POST['article-title'];
        $article_body = strip_tags($_POST['article-description']);

        $contact = new ArticleModel();
        $ans = $contact->insertArticleData($article_title, $article_body, $_SESSION['user_id']);

        if (empty($ans) == 1){
            echo $twig->render("articleForm.html.twig", ["status" => "true", "message" => "Article posted successfully!"]);
            return;
        }
        return;

    }
}
