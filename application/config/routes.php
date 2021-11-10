<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'welcome/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'welcome/dashboard';

//inventory
// item
$route['items'] = 'Items';
$route['item/insert'] = 'Items/insert';


//configuration
// menu
$route['configuration/menu'] = 'Configuration/menu';
$route['configuration/menu/category-insert'] = 'Configuration/menu/category_insert';