<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    if (Auth::user()) redirect(base_url("profile"));
    $this->load->view("auth/login");
    $this->session->set_flashdata("message",null);
    $this->session->set_flashdata("type",null);
  }

  function action(){
    if (Auth::user()) redirect(base_url("profile"));
    $params = [
      "email" => $this->input->post("email"),
      "password" => $this->input->post("password"),
    ];
    $this->load->model("auth/Login_model","model");
    $response = $this->model->action($params);
    if (!isset($response["code"])) {
      $this->session->set_flashdata("message","Internal Error");
      $this->session->set_flashdata("type","danger");
      redirect(base_url("login"));
    }

    if ($response["code"] !== 200) {
      $this->session->set_flashdata("message",$response["message"]);
      $this->session->set_flashdata("type","danger");
      redirect(base_url("login"));
    }


    Auth::register($response["data"]);
    $this->session->set_flashdata("message",$response["message"]);
    $this->session->set_flashdata("type","success");
    redirect(base_url("profile"));
  }

}
