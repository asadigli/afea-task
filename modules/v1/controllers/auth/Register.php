<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    if (Auth::user()) redirect(base_url("profile"));
    $this->load->view("auth/register");
    $this->session->set_flashdata("message",null);
    $this->session->set_flashdata("type",null);
  }

  function action(){
    if (Auth::user()) redirect(base_url("profile"));
    $params = [
      "name" => $this->input->post("name"),
      "surname" => $this->input->post("surname"),
      "email" => $this->input->post("email"),
      "password" => $this->input->post("password"),
      "confirm_password" => $this->input->post("confirm_password"),
    ];
    $this->load->model("auth/Register_model","model");
    $response = $this->model->action($params);
    if (!isset($response["code"])) {
      $this->session->set_flashdata("message","Internal Error");
      $this->session->set_flashdata("type","danger");
      redirect(base_url("register"));
    }

    if ($response["code"] !== 201) {
      $this->session->set_flashdata("message",$response["message"]);
      $this->session->set_flashdata("type","danger");
      redirect(base_url("register"));
    }


    $this->session->set_flashdata("message",$response["message"]);
    $this->session->set_flashdata("type","success");
    redirect(base_url("login"));
  }

}
