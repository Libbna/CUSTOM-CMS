<?php


namespace Cms\Services;

class DemoService
{
  public function helloWorld()
  {
    return "Hello World!\n";
  }

  public function currentDate(){
    $date = date('d/m/Y h:i:s');
    return $date;
  }
}