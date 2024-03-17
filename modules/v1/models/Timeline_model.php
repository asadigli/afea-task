<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline_model extends CI_Model{

  function __construct() {
    parent::__construct();
  }

  private $table_name = "sa_posts";

  /*
  * Table for storing post tags
  */
  private $seconday_table_name = "sa_post_tags";


  function share_post($params){
    if (!$params["title"] || !$params["body"]) {
      return [
        "code" => 409,
        "message" => "Please make sure you added title and body",
        "data" => []
      ];
    }

    $insert_list = $params;
    unset($insert_list["tags"]);
    $this->db->insert($this->table_name,$insert_list);
    $post = $this->db->insert_id();
    $tags = is_array($params["tags"]) ? $params["tags"] : explode(",",$params["tags"]);
    $tags = array_unique($tags);

    if ($post && $tags) {
      $tags_insert_list = [];
      foreach ($tags as $key => $tag) {
        $tags_insert_list[] = [
          "post_id" => $post,
          "tag" => trim($tag)
        ];
      }
      $tags_insert_list ? $this->db->insert_batch($this->seconday_table_name,$tags_insert_list) : "";
    }

    return [
      "code" => 201,
      "message" => "Post added successfully",
      "data" => $params
    ];
  }

  function postLive($params){
    if (!$params["user_id"]) {
      return [
        "code" => 409,
        "message" => "User must be mentioned",
        "data" => []
      ];
    }

    $posts_query = $this->db->select("id,title,image,body,created_at as added_date")
                              ->from($this->table_name)
                                ->where("user_id",$params["user_id"])
                                  ->where("deleted_at",null)
                                    ->order_by("created_at","desc")
                                      ->get();
    if (!$posts_query->num_rows()) {
      return [
        "code" => 204,
        "message" => "Post not found",
        "data" => []
      ];
    }
    $posts = $posts_query->result_array();

    $posts_ids = array_map(function($i){
      return $i["id"];
    },$posts);

    $post_tags_query = $this->db->select("post_id,tag")
                                  ->from($this->seconday_table_name)
                                    ->where_in("post_id",$posts_ids)
                                      ->where("deleted_at",null)
                                        ->get();
    $post_tags = $post_tags_query->result_array();
    $tags_by_id = [];
    foreach ($post_tags as $key => $tag) {
      $tags_by_id[$tag["post_id"]][] = $tag["tag"];
    }


    foreach ($posts as $key => $post) {
      $posts[$key]["tags"] = isset($tags_by_id[$post["id"]]) ? $tags_by_id[$post["id"]] : [];
    }

    return [
      "code" => 200,
      "message" => "Success",
      "data" => $posts
    ];
  }


  function delete($params){
    if (!$params["user_id"] || !$params["post"]) {
      return [
        "code" => 409,
        "message" => "User and post id cannot be empty",
        "data" => []
      ];
    }

    $posts_query = $this->db->select("id,user_id")
                              ->from($this->table_name)
                                ->where("id",$params["post"])
                                  ->where("deleted_at",null)
                                    ->limit(1)
                                      ->get();
    if (!$posts_query->num_rows()) {
      return [
        "code" => 204,
        "message" => "Post not found",
        "data" => []
      ];
    }

    $post = (array)$posts_query->row();

    if ($params["user_id"] !== $post["user_id"]) {
      return [
        "code" => 203,
        "message" => "User cannot delete this post",
        "data" => []
      ];
    }

    $this->db->where("id",$params["post"]);
    $this->db->update($this->table_name,["deleted_at" => date('Y-m-d H:i:s')]);

    $this->db->where("post_id",$params["post"]);
    $this->db->update($this->seconday_table_name,["deleted_at" => date('Y-m-d H:i:s')]);

    return [
      "code" => 200,
      "message" => "Post deleted",
      "data" => []
    ];
  }

}
