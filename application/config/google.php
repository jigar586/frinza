<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '253456019433-84k4ksjopurh2l6l6to0c5vget6i57q8.apps.googleusercontent.com';
$config['google']['client_secret']    = 'BPlis38ys21K8bs569-NHMkm';
$config['google']['redirect_uri']     = base_url('user/googleauth');
$config['google']['application_name'] = 'Frinza Login';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();
