<?php
namespace Cms\Controllers;

session_start();

use Cms\Models\AdminModel;
use mysqli;

class Admin extends ControllerBase
{
    public function displayUserDetails($twig)
    {
        $variables = parent::preprocesspage();
        if ($_SESSION['role'] != 'admin') {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = 'Access Prohibited!';
            echo $twig->render('error.html.twig', $variables);
            return;
        }
        $displayUsers = new AdminModel();
        $result = $displayUsers->displayUsers();
        $variables['result'] = $result;
        if (isset($_SESSION['user_id'])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        echo $twig->render('userDisplay.html.twig', $variables);
        return;
    }

    public function updateUserRoleToAdmin($twig, $id)
    {
        $variables = parent::preprocesspage();

        if ($_SESSION['role'] != 'admin') {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = 'Access Prohibited!';
            echo $twig->render('error.html.twig', $variables);
            return;
        }

        $userRole = new AdminModel();
        $result = $userRole->setUserToAdmin($id);
        if (empty($result) == 1) {
            $variables['status'] = 'true';
            $variables['message'] = 'User is now an Administrator!';
            $variables['title'] = $this->reverie . ' | Users';
            echo $twig->render('userDisplay.html.twig', $variables);
            return;
        }
        return;
    }

    public function updateUserRoleToAuth($twig, $id)
    {
        $variables = parent::preprocesspage();

        if ($_SESSION['role'] != 'admin') {
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['message'] = 'Access Prohibited!';
            echo $twig->render('error.html.twig', $variables);
            return;
        }

        $userRole = new AdminModel();
        $result = $userRole->setUserToAuth($id);
        if (empty($result) == 1) {
            $variables['status'] = 'true';
            $variables['message'] = 'User is now an Administrator!';
            $variables['title'] = $this->reverie . ' | Users';
            echo $twig->render('userDisplay.html.twig', $variables);
            return;
        }
        return;
    }
    public function userDelete($twig, $id)
    {
        $variables = parent::preprocesspage();
        $deleteUser = new AdminModel();
        $deleteUser->deleteUser($id);
        if (isset($_SESSION['user_id'])) {
            $variables['username'] = $_SESSION['username'];
            $variables['authenticated_userId'] = $_SESSION['user_id'];
            $variables['role'] = $_SESSION['role'];
        }
        $displayUsers = new AdminModel();
        $result = $displayUsers->displayUsers();
        $variables['result'] = $result;
        $variables['message'] = "User deleted successfully";
        $baseUrl = $variables['base_url'];
        header("Location:".$baseUrl."user-info");
        echo $twig->render('userDisplay.html.twig', $variables);
        return;
    }

    public function getConfigForm($twig)
    {
        $variables = parent::preprocessPage();
        echo $twig->render('config.html.twig', $variables);
        return;
    }

    public function configDetails($twig)
    {
        $variables = parent::preprocessPage();

        $site_name = $_POST['site_name'];

        $updateLogo = new AdminModel();
        $result = $updateLogo->displayLogo();
        $configRes = mysqli_fetch_assoc($result);
        $configId = $configRes['id'];
        $ans = $updateLogo->updateLogo($site_name, $configId);
        if ($_SESSION['role'] == 'admin') {
            if (isset($_SESSION['user_id'])) {
                if (empty($ans) == 1) {
                    $variables['username'] = $_SESSION['username'];
                    $variables['authenticated_userId'] = $_SESSION['user_id'];
                    $variables['role'] = $_SESSION['role'];
                    echo $twig->render('config.html.twig', $variables);
                    return;
                }
                return;
            }
        }
    }

    public function displayLogo($twig)
    {
        $variables = parent::preprocessPage();

        $displayLogo = new AdminModel();
        $result = $displayLogo->displayLogo();
        $variables['result'] = $result;

        echo $twig->render('header.html.twig', $variables);

        return;
    }
}
