<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\ArticleModel;
use Symfony\Component\HttpFoundation\Request;

class Article extends ControllerBase
{

    public function getContentPage($twig){

        if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != true) {
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }

        $variables = parent::preprocesspage();

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        echo $twig->render('content.html.twig', $variables);
    }

    public function getArticleForm($twig)
    {
        $variables = parent::preprocesspage();
        if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != true) {
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        $variables['role'] = $_SESSION['role'];
        $variables['authenticated_userId'] = $_SESSION['user_id'];
        $variables['username'] = $_SESSION['username'];
        $variables['title'] = $this->reverie . " | Article";
        echo $twig->render("articleForm.html.twig", $variables);
        return;
    }

    public function insertArticle($twig)
    {
        $variables = parent::preprocesspage();
        if (empty($_POST['article-title']) || empty($_POST['article-description']) || empty($_POST['article-category']) || empty($_POST['article_image'])) {
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

        if (empty($ans) == 1) {
            $variables['status'] = "true";
            $variables['message'] = "Article posted successfully!";
            $variables['role'] = $_SESSION['role'];
            $variables['title'] = $this->reverie . " | Article";
            echo $twig->render("articleForm.html.twig", $variables);
            return;
        }
        return;
    }

    public function fetchAllArticles($twig)
    {

        $variables = parent::preprocesspage();
        $articles = new ArticleModel();
        $result = $articles->fetchAllArticleData();
        $topicResult = $articles->fetchTopicWiseArticles();

        $variables['result'] = $result;
        $variables['topicResult'] = $topicResult;
        $variables['title'] = $this->reverie . " | Home";

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        echo $twig->render("home.html.twig", $variables);
    }


    public function getArticleById($twig, $blog_id)
    {
        $variables = parent::preprocesspage();
        $article = new ArticleModel();
        $result = $article->fetchArticleById($blog_id);
        $relatedBlogs = $article->fetchRelatedArticles();
        $categoryList = $article->fetchCategoryList();
        $popularPosts = $article->fetchPopularPosts();

        $variables['result'] = $result;
        $variables['relatedBlogs'] = $relatedBlogs;
        $variables['categoryList'] = $categoryList;
        $variables['popularPosts'] = $popularPosts;

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        $res_assoc = mysqli_fetch_assoc($result);
        $variables['title'] = $this->reverie . " | " . $res_assoc['title'];

        echo $twig->render("article.html.twig", $variables);
    }

    public function getCategoryList($twig)
    {
        $variables = parent::preprocesspage();
        $article = new ArticleModel();
        $result = $article->fetchCategoryList();

        $variables['result'] = $result;

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        echo $twig->render("sidebar.html.twig", $variables);
    }

    public function deleteArticle($twig, $article_id)
    {
        $variables = parent::preprocessPage();
        $article = new ArticleModel();
        $result = $article->deleteArticleById($article_id);

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        if (empty($ans) == 1) {
            $variables['status'] = "true";
            $variables['message'] = "Article deleted successfully!";
            $variables['role'] = $_SESSION['role'];
            $variables['title'] = $this->reverie . " | Article";
            echo $twig->render("home.html.twig", $variables);
            return;
        }

        return;
    }

    public function getEditForm($twig, $article_id)
    {
        $variables = parent::preprocessPage();
        
        if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != true) {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        $article = new ArticleModel();
        $result = $article->fetchArticleById($article_id);
        $variables['result'] = $result;

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }

        $res_assoc = mysqli_fetch_assoc($result);
        $variables['title'] = $this->reverie . " | " . $res_assoc['title'];

        echo $twig->render("articleEdit.html.twig", $variables);

        return;
    }

    public function editArticle($twig, $id)
    {
        $variables = parent::preprocessPage();
        if (empty($_POST['article-title']) && empty($_POST['article-description']) && empty($_POST['article-category'])) {
            $variables['message'] = "Enter all the article details!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }

        $article_title = $_POST['article-title'];
        $article_body = strip_tags($_POST['article-description']);
        $article_category = $_POST['article-category'];

        $contact = new ArticleModel();
        $ans = $contact->editArticleById($id, $article_title, $article_body, $article_category);

        if (empty($ans) == 1) {
            $variables['status'] = "true";
            $variables['message'] = "Article edited successfully!";
            $variables['role'] = $_SESSION['role'];
            $variables['title'] = $this->reverie . " | Home";
            $baseUrl = $variables['base_url'];
            header("Location:".$baseUrl."article/{$id}");
            echo $twig->render("article.html.twig", $variables);
            return;
        }
        return;
    }

    public function search($twig){

        $variables = parent::preprocessPage();

        $request = Request::createFromGlobals();
        $uri = $request->getRequestUri();
        $params = explode("=", $uri);
        $query = $params[1];
        
        if (str_contains($query, '+')){
            $filteredQuery = str_replace('+', ' ', $query);
            $searchQuery = $filteredQuery;
        } else {
            $searchQuery = $query;
        }
        
        $searchItem = '%'.$searchQuery.'%';

        $search = new ArticleModel();
        $result = $search->searchQuery($searchItem);
        $variables['result'] = $result;
        $variables['query'] = $searchQuery;

        if (isset($_SESSION["user_id"])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        
        $variables['len'] = mysqli_num_rows($result);
        echo $twig->render("searchResults.html.twig", $variables);
        return;
    }
}
