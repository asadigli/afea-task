<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'v1/home/redirect';
$route['404_override'] = 'v1/home/redirect';
$route['translate_uri_dashes'] = FALSE;

$route['profile'] = 'v1/account';
$route['logout'] = 'v1/account/logout';

$route["timeline"] = "v1/timeline";
$route["posts-live"] = "v1/timeline/postLive";
$route["post/(:any)/delete"]["delete"] = "v1/timeline/delete/$1";

$route["share-post"]["post"] = "v1/timeline/share_post";

$route['login'] = 'v1/auth/login';
$route['login-action']["post"] = 'v1/auth/login/action';

$route['register'] = 'v1/auth/register';
$route['register-action']["post"] = 'v1/auth/register/action';
