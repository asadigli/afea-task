<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    if (!Auth::user()) redirect(base_url("login"));
    $this->load->view("profile");
    $this->session->set_flashdata("message",null);
    $this->session->set_flashdata("type",null);
  }


  function logout() {
    if (!Auth::user()) redirect(base_url("login"));
    Auth::logout();
    redirect(base_url("login"));
  }

}
