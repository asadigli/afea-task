<?php

if (!function_exists("assets")) {
  function assets($path){
    return base_url("assets/".$path."?v=".uniqid());
  }
}
