<?php


namespace Cms\Services\ServicesClass;

class DateService
{
  public function currentDate(){
    $date = date('d/m/Y h:i:s');
    return $date;
  }
}