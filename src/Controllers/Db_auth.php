<?php
namespace Cms\Controllers;

use Cms\User\DatabaseUserProvider;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class Db_auth
{
    
    public $conn;
    
    public function userAuth($twig)
    {
        $conn = mysqli_connect('localhost', 'root', 'root', 'custom_cms');
        if (!$conn) {
            echo "<h1>Datbase connection failed</h1>";
        }

        // init our custom db user provider
        $userProvider = new DatabaseUserProvider($conn);

        try {
            // init un/pw, usually you'll get these from the $_POST variable, submitted by the end user
            $username = 'admin';
            $password = 'admin';
            
            $user = $userProvider->getUser($username);
            $hashed_password =  $user->getPassword();

            if ($password == $hashed_password){
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
}
