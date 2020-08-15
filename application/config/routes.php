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
$route['api/login'] = 'ApiCtrl/index_post';
$route['api/payment'] = 'ApiCtrl/index_post';
$route['api/get-wallet'] = 'ApiCtrl/index_get';
$route['api/get-alllog'] = 'ApiCtrl/index_get';
$route['api/get-log'] = 'ApiCtrl/index_get';
$route['api/get-userdata'] = 'ApiCtrl/index_get';
$route['api/update-userdata'] = 'ApiCtrl/index_post';

#############################################################################################################
# http://localhost/moneytransfer/api/signup             --post-- [signup|name|adharno|mobileno|yourid]      #
# http://localhost/moneytransfer/api/login              --post-- [login|mobileno|yourid]                    #
# http://localhost/moneytransfer/api/payment            --post-- [payment|sid|rname|rmobile|ramount|rtoken] #
# http://localhost/moneytransfer/api/get-wallet         --get--  [wallet|uid]                               #
# http://localhost/moneytransfer/api/get-alllog         --get--  [alllog|uid]                               #
# http://localhost/moneytransfer/api/get-log            --get--  [log|uid]                                  #
# http://localhost/moneytransfer/api/get-userdata       --get--  [userdata|uid]                             #
# http://localhost/moneytransfer/api/update-userdata    --post-- [update|name|yourid|conf_yourid]           #
#############################################################################################################