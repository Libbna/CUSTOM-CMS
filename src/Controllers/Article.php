<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\ArticleModel;
use Symfony\Component\HttpFoundation\Request;

/**
 * {@inheritdoc}
 */
class Article extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function getContentPage($twig) {
    if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != TRUE) {
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

  /**
   * {@inheritdoc}
   */
  public function getArticleForm($twig) {
    $variables = parent::preprocesspage();
    if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != TRUE) {
      $variables['message'] = "Access Prohibited!";
      echo $twig->render("error.html.twig", $variables);
    }
    $variables['role'] = $_SESSION['role'];
    $variables['authenticated_userId'] = $_SESSION['user_id'];
    $variables['username'] = $_SESSION['username'];
    $variables['title'] = $this->reverie . " | Article";
    echo $twig->render("articleForm.html.twig", $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function insertArticle($twig) {
    $variables = parent::preprocesspage();
    $request = Request::createFromGlobals();
    $article_title = $request->request->get('article-title');
    $article_body = $request->request->get('article-description');

    if (empty($article_title) || empty($article_body)) {
      $variables['message'] = "Enter all the article details!";
      echo $twig->render("error.html.twig", $variables);
    }
    $article_category = $request->request->get('article-category');
    $article_image = $request->request->get('article_image');

    $contact = new ArticleModel();
    $ans = $contact->insertArticleData($article_title, $article_body, $_SESSION['user_id'], $article_category, $article_image);

    if (empty($ans) == 1) {
      $variables['status'] = "true";
      $variables['message'] = "Article posted successfully!";
      $variables['role'] = $_SESSION['role'];
      $variables['title'] = $this->reverie . " | Article";
      echo $twig->render("articleForm.html.twig", $variables);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function fetchAllArticles($twig) {

    $variables = parent::preprocesspage();
    $articles = new ArticleModel();
    $result = $articles->fetchAllArticleData();
    $topicResult = $articles->fetchTopicWiseArticles();
    $categoryList = $articles->fetchCategoryList();

    $variables['result'] = $result;
    $variables['topicResult'] = $topicResult;
    $variables['categoryList'] = $categoryList;
    $variables['title'] = $this->reverie . " | Home";

    if (isset($_SESSION["user_id"])) {
      $variables['username'] = $_SESSION['username'];
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['role'] = $_SESSION['role'];
    }

    echo $twig->render("home.html.twig", $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function getArticleById($twig, $blog_id) {
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

  /**
   * {@inheritdoc}
   */
  public function getCategoryList($twig) {
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

  /**
   * {@inheritdoc}
   */
  public function deleteArticle($twig, $article_id) {
    $variables = parent::preprocessPage();
    $article = new ArticleModel();
    $article->deleteArticleById($article_id);

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
  }

  /**
   * {@inheritdoc}
   */
  public function getEditForm($twig, $article_id) {
    $variables = parent::preprocessPage();

    if (!isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] != TRUE) {
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
  }

  /**
   * {@inheritdoc}
   */
  public function editArticle($twig, $id) {
    $variables = parent::preprocessPage();
    $request = Request::createFromGlobals();
    $article_title = $request->request->get('article-title');
    $article_body = $request->request->get('article-description');
    $article_category = $request->request->get('article-category');

    if (empty($article_title) && empty($article_body) && empty($article_category)) {
      $variables['message'] = "Enter all the article details!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }

    $contact = new ArticleModel();
    $ans = $contact->editArticleById($id, $article_title, $article_body, $article_category);

    if (empty($ans) == 1) {
      $variables['status'] = "true";
      $variables['message'] = "Article edited successfully!";
      $variables['role'] = $_SESSION['role'];
      $variables['title'] = $this->reverie . " | Home";
      $baseUrl = $variables['base_url'];
      header("Location:" . $baseUrl . "article/{$id}");
      echo $twig->render("article.html.twig", $variables);
      return;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function search($twig) {

    $variables = parent::preprocessPage();

    $request = Request::createFromGlobals();
    $uri = $request->getRequestUri();
    $params = explode("=", $uri);
    $query = $params[1];

    if (str_contains($query, '+')) {
      $filteredQuery = str_replace('+', ' ', $query);
      $searchQuery = $filteredQuery;
    }
    else {
      $searchQuery = $query;
    }

    $searchItem = '%' . $searchQuery . '%';

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
  }

  /**
   * {@inheritdoc}
   */
  public function fetchCategoryWiseArticles($twig, $query) {
    $articles = new ArticleModel();
    $result = $articles->fetchTopicWiseArticles($query);
    $emparray = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $emparray[] = $row;
    }

    $response = json_encode($emparray);

    header('Content-type: application/json');
    echo $response;
  }

}
