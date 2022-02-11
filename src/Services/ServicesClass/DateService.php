<?php

namespace Cms\Services\ServicesClass;

/**
 * {@inheritdoc}
 */
class DateService {

  /**
   * {@inheritdoc}
   */
  public function currentDate() {
    $date = date('d/m/Y h:i:s');
    return $date;
  }

}
