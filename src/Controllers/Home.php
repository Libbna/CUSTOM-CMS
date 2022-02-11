<?php

namespace Cms\Controllers;

use Cms\Services\Container;

session_start();
/**
 * {@inheritdoc}
 */
class Home extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public static function getData($twig) {
    $variables = parent::preprocesspage();
    if (isset($_SESSION["user_id"])) {
      $variables['username'] = $_SESSION['username'];
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['role'] = $_SESSION['role'];
    }
    echo $twig->render('home.html.twig', $variables);
  }

  /**
   * {@inheritdoc}
   */
  public function demoFunc($twig) {
    $serviceOne = new Container();
    $result = $serviceOne->yamlService('current_date.service');
    echo $result->currentDate();
    die;
  }

}
