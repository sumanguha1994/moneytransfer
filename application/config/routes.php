<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['migrate'] = 'Migrate';
//admin
$route['admin'] = 'Welcome';
$route['dash'] = 'Welcome/dashboard';
$route['login'] = 'Welcome/login';
$route['logout'] = 'Welcome/logout';

//api
$route['api/signup'] = 'ApiCtrl/index_post';
$route['api/login'] = 'ApiCtrl/index_post_login';