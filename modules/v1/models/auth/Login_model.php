<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  function __construct() {
    parent::__construct();
  }

  private $table_name = "sa_users";

  function action($params){
    if (!$params["email"] || !$params["password"]) {
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

    $user_exist_query = $this->db->select("id,name,surname,email,password")
                                  ->from($this->table_name)
                                    ->where("email",$params["email"])
                                      ->where("deleted_at",null)
                                        ->limit(1)
                                          ->get();
    if (!$user_exist_query->num_rows()) {
      return [
        "code" => 204,
        "message" => "User not found",
        "data" => []
      ];
    }


    $user_row = (array)$user_exist_query->row();


    if (!password_verify($params["password"],$user_row["password"])) {
      return [
        "code" => 409,
        "message" => "Email or password is wrong",
        "data" => []
      ];
    }

    unset($user_row["password"]);

    return [
      "code" => 200,
      "message" => "Logged in successfully",
      "data" => $user_row
    ];

  }


}
