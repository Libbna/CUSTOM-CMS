<?php

namespace Cms\Controllers;

session_start();

use Cms\Models\Database;
use Symfony\Component\HttpFoundation\Request;

/**
 * {@inheritdoc}
 */
class Menu extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function displayMenuForm($twig) {

    $variables = parent::preprocesspage();
    if (!isset($_SESSION["loggedin"])) {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = "Access Prohibited!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }
    if (isset($_SESSION["user_id"])) {
      $variables['username'] = $_SESSION['username'];
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['role'] = $_SESSION['role'];
    }
    $variables['title'] = $this->reverie . " | Enter Menu";
    echo $twig->render('menu.html.twig', $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function insertCustomMenu($twig) {

    $variables = parent::preprocesspage();
    $request = Request::createFromGlobals();
    $menu_title = $request->request->get('menu-title');
    $menu_link = $request->request->get('menu-link');
    if (empty($menu_title) || empty($menu_link)) {
      $variables['message'] = "Enter all the details";
      echo $twig->render('error.html.twig', $variables);
      return;
    }

    $newMenu = new Database();
    $result = $newMenu->insertMenuDetails($menu_title, $menu_link);
    $variables['result'] = $result;
    $variables['role'] = $_SESSION['role'];
    $variables['title'] = $this->reverie . " | Menu";
    $baseUrl = $variables['base_url'];
    header("Location:" . $baseUrl . "menu-form");
    echo $twig->render('menu.html.twig', $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function displayCustomMenu($twig) {

    $variables = parent::preprocesspage();
    if (!isset($_SESSION["loggedin"])) {
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['message'] = "Access Prohibited!";
      echo $twig->render("error.html.twig", $variables);
      return;
    }
    $displayMenuList = new Database();
    $result = $displayMenuList->displayMenu();
    $variables['result'] = $result;
    if (isset($_SESSION["user_id"])) {
      $variables['username'] = $_SESSION['username'];
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['role'] = $_SESSION['role'];
    }
    $variables['title'] = $this->reverie . " | Menus";
    echo $twig->render('menuDisplay.html.twig', $variables);
  }

}
