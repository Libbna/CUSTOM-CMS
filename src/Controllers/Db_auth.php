<?php

namespace Cms\Controllers;

use Cms\User\DatabaseUserProvider;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class Db_auth
{

    public $conn;

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

    public function userAuth($twig)
    {
        // $conn = mysqli_connect('localhost', 'root', 'root', 'custom_cms');
        // if (!$conn) {
        //     echo "<h1>Datbase connection failed</h1>";
        // }

        // init our custom db user provider
        $userProvider = new DatabaseUserProvider($this->conn);

        try {
            // init un/pw, usually you'll get these from the $_POST variable, submitted by the end user
            $username = 'admin';
            $password = 'admin';

            $user = $userProvider->getUser($username);
            $hashed_password =  $user->getPassword();

            if ($password == $hashed_password) {
                echo "Authentication successful";
            }

            echo $twig->render('home.html.twig');
            return;


            echo "\n";
        } catch (AuthenticationException $e) {
            echo $e->getMessage();
            echo "\n";
        }
    }

    public function userRegistration($twig)
    {

        if (isset($_POST['userName']) and isset($_POST['userPassword']) and $_POST['userConfirmPassword']) {

            $username = $_POST['userName'];
            $password = $_POST['userPassword'];
            $confirmPassword = $_POST['userConfirmPassword'];
        } else{
            echo $twig->render("error.html.twig", ["message" => "Enter all the details!"]);
            return;
        }

        if ($password == $confirmPassword){
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
        }

        $userProvider = new DatabaseUserProvider($this->conn);
        $insertUser = $userProvider->insertUser($username, $hash_password);

        if ($insertUser){
            echo $twig->render("loginForm.html.twig", ["status" => "true","message" => "Registeration successful"]);
            return;
        } else {
            echo $twig->render("registerForm.html.twig", ["status" => "false", "message" => "Registration not successful"]);
            return;
        }
    }

    public function getLoginForm($twig)
    {
        echo $twig->render('loginForm.html.twig');
        return;
    }

    public function getRegisterForm($twig)
    {
        echo $twig->render('registerForm.html.twig');
        return;
    }
}
