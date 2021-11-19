<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome/dashboard';
$route['404_override'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'welcome/dashboard';

//inventory
// item
$route['items'] = 'Items';
$route['item/insert'] = 'Items/insert';
$route['items/getcode'] = 'Items/getcode';
$route['items/getitem'] = 'Items/getitem';
$route['item/delete'] = 'Items/delete';
$route['item/update'] = 'Items/update';

// item stock
$route['stocks'] = 'Stock';
$route['stocks/get-item'] = 'Stock/getitem';
$route['stocks/get-history'] = 'Stock/gethistory';

//invoice
$route['invoice'] = 'Invoice';
$route['invoice/info'] = 'Invoice/info';
$route['invoice/user-info'] = 'Invoice/user_info';

//USER;
//customer
$route['customer'] = 'Users/customer';

//configuration
// menu
$route['configuration/menu'] = 'Configuration/menu';
$route['configuration/menu/category-insert'] = 'Configuration/menu/category_insert';