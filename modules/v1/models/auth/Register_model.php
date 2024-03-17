<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{

  function __construct() {
    parent::__construct();
  }

  private $table_name = "sa_users";

  function action($params){
    if (!$params["name"] || !$params["surname"] || !$params["email"]
          || !$params["password"] || !$params["confirm_password"]) {
      return [
        "code" => 409,
        "message" => "Fill all the fields",
        "data" => []
      ];
    }


    if (!filter_var($params["email"], FILTER_VALIDATE_EMAIL)) {
      return [
        "code" => 409,
        "message" => "Invalid email address",
        "data" => []
      ];
    }

    if ($params["password"] !== $params["confirm_password"]) {
      return [
        "code" => 409,
        "message" => "Password not matched",
        "data" => []
      ];
    }

    $user_exist_query = $this->db->select("id")
                                  ->from($this->table_name)
                                    ->where("email",$params["email"])
                                      ->where("deleted_at",null)
                                        ->get();
    if ($user_exist_query->num_rows()) {
      return [
        "code" => 226,
        "message" => "User already created",
        "data" => []
      ];
    }


    $params["password"] = password_hash($params["password"],PASSWORD_DEFAULT);
    unset($params["confirm_password"]);
    $this->db->insert($this->table_name,$params);


    return [
      "code" => 201,
      "message" => "User created successfully",
      "data" => []
    ];
  }

}
