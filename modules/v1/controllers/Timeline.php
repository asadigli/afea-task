<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  function index()
  {
    $this->load->view("timeline");
  }

  function share_post(){
    $params = [
      "user_id" => Auth::user(),
      "title" => $this->input->post("title"),
      "image" => $this->input->post("image"),
      "tags" => $this->input->post("tags"),
      "body" => $this->input->post("body"),
    ];
    $this->load->model("Timeline_model","model");
    $response = $this->model->share_post($params);
    $this->response($response);
  }


  function postLive(){
    $params = [
      "user_id" => Auth::user(),
      "keyword" => $this->input->get("keyword")
    ];
    $this->load->model("Timeline_model","model");
    $response = $this->model->postLive($params);
    $this->response($response);
  }


  function delete($id){
    $params = [
      "user_id" => Auth::user(),
      "post" => $id
    ];
    $this->load->model("Timeline_model","model");
    $response = $this->model->delete($params);
    $this->response($response);
  }

}
