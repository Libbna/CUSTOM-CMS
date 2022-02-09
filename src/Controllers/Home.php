<?php

namespace Cms\Controllers;

use Cms\Services\Container;

session_start();
/**
 *
 */
class Home extends ControllerBase {

  /**
   *
   */
  public static function getData($twig) {
    $variables = parent::preprocesspage();
    if (isset($_SESSION["user_id"])) {
      $variables['username'] = $_SESSION['username'];
      $variables['authenticated_userId'] = $_SESSION['user_id'];
      $variables['role'] = $_SESSION['role'];
    }
    echo $twig->render('home.html.twig', $variables);
    return;
  }

  /**
   *
   */
    public function DemoFunc($twig){
      $variables = parent::preprocesspage();
      $serviceOne = new Container();
      $result = $serviceOne->yaml_service('current_date.service');
      echo $result->currentDate();
      die;
      return;
    }

}
