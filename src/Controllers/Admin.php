<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\AdminModel;
use Symfony\Component\HttpFoundation\Request;

/**
 * {@inheritdoc}
 */
class Admin extends ControllerBase {

  /**
   * Display user details.
   */
  public function displayUserDetails($twig) {
    $variables = parent::preprocesspage();
    if ($_SESSION['role'] != 'admin') {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = 'Access Prohibited!';
      echo $twig->render('error.html.twig', $variables);
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
  }

  /**
   * Update use role to admin.
   */
  public function updateUserRoleToAdmin($twig, $id) {
    $variables = parent::preprocesspage();

    if ($_SESSION['role'] != 'admin') {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = 'Access Prohibited!';
      echo $twig->render('error.html.twig', $variables);
    }

    $userRole = new AdminModel();
    $result = $userRole->setUserToAdmin($id);
    if (empty($result) == 1) {
      $variables['status'] = 'true';
      $variables['message'] = 'User is now an Administrator!';
      $variables['title'] = $this->reverie . ' | Users';
      $displayUsers = new AdminModel();
      $users = $displayUsers->displayUsers();
      $variables['result'] = $users;
      $variables['message'] = 'User deleted successfully';
      $baseUrl = $variables['base_url'];
      header('Location:' . $baseUrl . 'user-info');
      echo $twig->render('userDisplay.html.twig', $variables);
    }
  }

  /**
   * Update user role to Authenticated.
   */
  public function updateUserRoleToAuth($twig, $id) {
    $variables = parent::preprocesspage();

    if ($_SESSION['role'] != 'admin') {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = 'Access Prohibited!';
      echo $twig->render('error.html.twig', $variables);
    }

    $userRole = new AdminModel();
    $result = $userRole->setUserToAuth($id);
    if (empty($result) == 1) {
      $variables['status'] = 'true';
      $variables['message'] = 'User is now an Administrator!';
      $variables['title'] = $this->reverie . ' | Users';
      $displayUsers = new AdminModel();
      $users = $displayUsers->displayUsers();
      $variables['result'] = $users;
      $variables['message'] = 'User deleted successfully';
      $baseUrl = $variables['base_url'];
      header('Location:' . $baseUrl . 'user-info');
      echo $twig->render('userDisplay.html.twig', $variables);
    }
  }

  /**
   * Function to delete user.
   */
  public function userDelete($twig, $id) {
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
    $variables['message'] = 'User deleted successfully';
    $baseUrl = $variables['base_url'];
    header('Location:' . $baseUrl . 'user-info');
    echo $twig->render('userDisplay.html.twig', $variables);
  }

  /**
   * To render the config form.
   */
  public function getConfigForm($twig) {
    $variables = parent::preprocessPage();
    if ($_SESSION['role'] == 'admin') {
      if (isset($_SESSION['user_id'])) {
        $variables['username'] = $_SESSION['username'];
        $variables['authenticated_userId'] = $_SESSION['user_id'];
        $variables['role'] = $_SESSION['role'];
        $variables['title'] = $this->reverie . ' | Config';
        echo $twig->render('config.html.twig', $variables);
      }
    }
  }

  /**
   * To insert the config details.
   */
  public function configDetails($twig) {
    $variables = parent::preprocessPage();
    $request = Request::createFromGlobals();

    $site_name = $request->request->get('site_name');
    $alt_text = $request->request->get('alt_text');
    if (empty($site_name)) {
      $variables['message'] = 'Please enter all the fields!';
      echo $twig->render('error.html.twig', $variables);
    }

    $footer_desc = $request->request->get('footer_desc');

    $footer_location = $request->request->get('footer_location');
    $footer_contact = $request->request->get('footer_contact');
    $footer_email = $request->request->get('footer_email');

    $updateConfig = new AdminModel();
    $result = $updateConfig->displayLogo();
    $configRes = mysqli_fetch_assoc($result);
    $configId = $configRes['id'];
    $logoAns = $updateConfig->updateLogo($site_name, $alt_text, $configId);

    $footerResult = $updateConfig->updateFooter(
          $footer_desc,
          $footer_location,
          $footer_contact,
          $footer_email
      );

    if ($_SESSION['role'] == 'admin') {
      if (isset($_SESSION['user_id'])) {
        if (empty($logoAns) == 1 && empty($footerResult == 1)) {
          $variables['username'] = $_SESSION['username'];
          $variables['authenticated_userId'] = $_SESSION['user_id'];
          $variables['role'] = $_SESSION['role'];
          $variables['message'] = 'Config is added';
          $variables['status'] = 'true';
          $variables['title'] = $this->reverie . ' | Config';
          $baseUrl = $variables['base_url'];
          header('Location:' . $baseUrl . 'config-form');
          echo $twig->render('config.html.twig', $variables);
        }
      }
    }
  }

  /**
   * To display the logo.
   */
  public function displayLogo($twig) {
    $variables = parent::preprocessPage();

    $displayLogo = new AdminModel();
    $result = $displayLogo->displayLogo();
    $variables['result'] = $result;

    echo $twig->render('header.html.twig', $variables);
  }

  /**
   * Display the add user form.
   */
  public function displayAddUserForm($twig) {
    $variables = parent::preprocessPage();
    $variables['username'] = $_SESSION['username'];
    $variables['role'] = $_SESSION['role'];
    $variables['authenticated_userId'] = $_SESSION['user_id'];
    $variables['title'] = $this->reverie . ' | Add User';
    echo $twig->render('userForm.html.twig', $variables);
  }

}
