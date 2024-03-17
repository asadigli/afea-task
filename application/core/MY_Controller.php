<?php

date_default_timezone_set('Asia/Baku');

class MY_Controller extends MX_Controller
{

  function __construct()
  {
    parent::__construct();
  }


  function response($data){
    if (!is_array($data)) {
      die($data);
    }
    header('Content-Type: application/json');
    echo json_encode($data);
  }

}
