<?php

namespace Cms\Services\ServicesClass;

/**
 * {@inheritdoc}
 */
class DemoService {

  /**
   * {@inheritdoc}
   */
  public function helloWorld() {
    return "Hello World!\n";
  }

  /**
   * {@inheritdoc}
   */
  public function currentDate() {
    $date = date('d/m/Y h:i:s');
    return $date;
  }

}
