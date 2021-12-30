<?php

namespace Cms\Controllers;

session_start();

use Cms\User\DatabaseUserProvider;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class Db_auth extends ControllerBase
{

    public $conn;
    //establishing database connection
    public function __construct()
    {
        require './dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Database connection failed</h1>";
            return;
        }
    }

    public function userAuth($twig)
    {
        // init our custom db user provider
        $userProvider = new DatabaseUserProvider($this->conn);

        try {
            $variables = parent::preprocesspage();
            if (isset($_POST['userName']) and isset($_POST['userPassword'])) {

                $username = $_POST['userName'];
                $password = $_POST['userPassword'];
            } else {
                $variables['message'] = "Enter all the details!";
                echo $twig->render("error.html.twig", $variables);
                return;
            }

            $user = $userProvider->getUser($username);
            $hashed_password =  $user->getPassword();


            if (password_verify($password, $hashed_password)) {
                $auth_user = $user->getUsername();

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user->getUserId();
                $_SESSION['username'] = $auth_user;
                $_SESSION['role'] = $user->getRoles();

                $variables['username'] = $auth_user;
                $variables['role'] = $_SESSION['role'];
                $variables['message'] = "Login Successful, Welcome";
                echo $twig->render("home.html.twig", $variables);
                return;
            } else {

                $variables['status'] = "false";
                $variables['message'] = "Login Successful, Welcome";
                echo $twig->render("loginForm.html.twig", $variables);
                return;
            }

            echo "\n";
        } catch (AuthenticationException $e) {
            echo $e->getMessage();
            echo "\n";
        }
    }

    public function userRegistration($twig)
    {
        $variables = parent::preprocesspage();
        if (isset($_POST['userName']) and isset($_POST['userPassword']) and $_POST['userConfirmPassword']) {

            $username = $_POST['userName'];
            $password = $_POST['userPassword'];
            $confirmPassword = $_POST['userConfirmPassword'];
        } else {
            $variables['message'] = "Enter all the details!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }

        if ($password == $confirmPassword) {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
        }

        $userProvider = new DatabaseUserProvider($this->conn);
        $insertUser = $userProvider->insertUser($username, $hash_password);
    
        if ($insertUser) {
            $variables['status'] = "true";
            $variables['message'] = "Registeration successful";
            echo $twig->render("loginForm.html.twig", $variables);
            return;
        } else {
            $variables['status'] = "false";
            $variables['message'] = "Registeration not successful";
            echo $twig->render("registerForm.html.twig", $variables);
            return;
        }
    }

    public function getLoginForm($twig)
    {
        $variables = parent::preprocesspage();
        if (isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] == true) {
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        echo $twig->render('loginForm.html.twig', $variables);
        return;
    }

    public function getRegisterForm($twig)
    {
        $variables = parent::preprocesspage();
        if (isset($_SESSION["loggedin"]) and $_SESSION['loggedin'] == true) {
            $variables['message'] = "Access Prohibited!";
            echo $twig->render("error.html.twig", $variables);
            return;
        }
        echo $twig->render('registerForm.html.twig', $variables);
        return;
    }

    public function logout($twig)
    {
        session_start();
        session_unset();
        session_destroy();
        $variables = parent::preprocesspage();
        $variables['status'] = "true";
        $variables['message'] = "You have logged out!";
        echo $twig->render("loginForm.html.twig", $variables);
        return;
    }
}
