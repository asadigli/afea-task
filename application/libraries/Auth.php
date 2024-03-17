<?php

/**
 *
 */
class Auth {

  public static function register($data){
    $CI = get_instance();
    // var_dump($data);die;
    $CI->session->set_userdata([
      "id" => isset($data["id"]) ? $data["id"] : NULL,
      "name" => isset($data["name"]) ? $data["name"] : NULL,
      "surname" => isset($data["surname"]) ? $data["surname"] : NULL,
      "email" => isset($data["email"]) ? $data["email"] : NULL
    ]);
  }

  public static function logout(){
    $CI = get_instance();
    $CI->session->unset_userdata(["id","name","surname","email",]);
  }

  public static function user(){
    $CI = get_instance();
    return $CI->session->userdata("id");
  }


  public static function email(){
    $CI = get_instance();
    return $CI->session->userdata("email");
  }

  public static function full_name(){
    $CI = get_instance();
    return $CI->session->userdata("name") . " " . $CI->session->userdata("surname");
  }

}
