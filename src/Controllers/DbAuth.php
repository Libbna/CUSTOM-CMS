<?php

namespace Cms\Controllers;

// session_start();
use Cms\User\DatabaseUserProvider;
use Cms\Models\AdminModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * {@inheritdoc}
 */
class DbAuth extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public $conn;

  /**
   * Establishing database connection.
   */
  public function __construct() {
    require './dbconfig.php';

    $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
    if (!$this->conn) {
      echo "<h1>Database connection failed</h1>";
      return;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function userAuth($twig) {
    // Init our custom db user provider.
    $userProvider = new DatabaseUserProvider($this->conn);

    try {
      $variables = parent::preprocesspage();
      $request = Request::createFromGlobals();
      $userName = $request->request->get('userName');
      $userPassword = $request->request->get('userPassword');
      if (!empty($userName) && !empty($userPassword)) {
        $username = $userName;
        $password = $userPassword;
      }
      else {
        $variables['message'] = "Enter all the details!";
        echo $twig->render("error.html.twig", $variables);
        return;
      }

      $user = $userProvider->getUser($username);

      if (!$user) {
        $variables['error'] = "Username Not Found";
        $variables['title'] = $this->reverie . " | Login";
        echo $twig->render("loginForm.html.twig", $variables);
      }
      $hashed_password = $user->getPassword();

      if (password_verify($password, $hashed_password)) {
        $auth_user = $user->getUsername();
        // session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['username'] = $auth_user;
        $_SESSION['role'] = $user->getRoles();

        $variables['username'] = $auth_user;
        $variables['role'] = $_SESSION['role'];
        $variables['authenticated_userId'] = $_SESSION['user_id'];
        $variables['message'] = "Login Successful, Welcome";
        $variables['title'] = $this->reverie . " | Welcome";
        $baseUrl = $variables['base_url'];
        header("Location:" . $baseUrl . "home");
        echo $twig->render("home.html.twig", $variables);
        return;
      }
      else {

        $variables['status'] = "false";
        $variables['message'] = "Login Successful, Welcome";
        $variables['title'] = $this->reverie . " | Login";
        $baseUrl = $variables['base_url'];
        header("Location:" . $baseUrl . "login");
        echo $twig->render("loginForm.html.twig", $variables);
        return;
      }

      echo "\n";
    }
    catch (AuthenticationException $e) {
      echo $e->getMessage();
      echo "\n";
    }
  }

  /**
   * {@inheritdoc}
   */
  public function userRegistration($twig) {
    $variables = parent::preprocesspage();
    $request = Request::createFromGlobals();
    $userName = $request->request->get('userName');
    $userPassword = $request->request->get('userPassword');
    $userConfirmPassword = $request->request->get('userConfirmPassword');
    $role = $request->request->get('role');
    if (!empty($userName) && !empty($userPassword) && !empty($userConfirmPassword) && !empty($role)) {

      $username = $userName;
      $password = $userPassword;
      $confirmPassword = $userConfirmPassword;
      $role = $role;
    }
    else {
      $variables['message'] = "Enter all the details!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }

    if ($password == $confirmPassword) {
      $hash_password = password_hash($password, PASSWORD_DEFAULT);
    }

    $userTableEmpty = new AdminModel();
    $result = $userTableEmpty->usersEmpty();
    $noOfRows = mysqli_num_rows($result);
    $userProvider = new DatabaseUserProvider($this->conn);
    if ($noOfRows == 0) {
      $insertMainUser = $userProvider->insertUser($username, $hash_password, "admin");
      ;
    }
    else {
      $insertUser = $userProvider->insertUser($username, $hash_password, $role);
    }

    if ($insertUser || $insertMainUser) {
      $variables['status'] = "true";
      $variables['message'] = "Registeration successful";
      $variables['title'] = $this->reverie . " | Register";
      $baseUrl = $variables['base_url'];
      if (isset($_SESSION['role'])) {
        header("Location:" . $baseUrl . "user-form");
        echo $twig->render("userForm.html.twig", $variables);
      }
      else {
        header("Location:" . $baseUrl . "login");
        echo $twig->render("loginForm.html.twig", $variables);
      }
      return;
    }
    else {
      $variables['status'] = "false";
      $variables['message'] = "Registeration not successful";
      $variables['title'] = $this->reverie . " | Register";
      $baseUrl = $variables['base_url'];
      if (isset($_SESSION['role'])) {
        header("Location:" . $baseUrl . "user-form");
        echo $twig->render("userForm.html.twig", $variables);
      }
      else {
        header("Location:" . $baseUrl . "register");
        echo $twig->render("registerForm.html.twig", $variables);
      }
      return;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getLoginForm($twig) {
    $variables = parent::preprocesspage();
    if (isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] == TRUE) {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = "Access Prohibited!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }
    $variables['title'] = $this->reverie . " | Login";
    echo $twig->render('loginForm.html.twig', $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function getRegisterForm($twig) {
    $variables = parent::preprocesspage();
    if (isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] == TRUE) {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = "Access Prohibited!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }
    $variables['title'] = $this->reverie . " | Register";
    echo $twig->render('registerForm.html.twig', $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function logout($twig) {
    session_start();
    session_unset();
    session_destroy();
    $variables = parent::preprocesspage();
    $variables['status'] = "true";
    $variables['message'] = "You have logged out!";
    $variables['title'] = $this->reverie . " | Logout";
    $baseUrl = $variables['base_url'];
    header("Location:" . $baseUrl . "login");
    echo $twig->render("loginForm.html.twig", $variables);
  }

}
