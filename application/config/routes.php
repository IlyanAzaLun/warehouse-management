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
$route['purchase'] = 'Invoices/purchasing';
$route['purchase/info'] = 'Invoices/purchasing/info';
$route['purchase/user-info'] = 'Invoices/purchasing/user_info';

$route['sale'] = 'Invoices/selling';
$route['sale/info'] = 'Invoices/Selling/info';
$route['sale/user-info'] = 'Invoices/Selling/user_info';

//USER;
$route['user/delete'] = 'Users/supplier/delete';
$route['user/select'] = 'Users/supplier/getuser';
$route['user/update'] = 'Users/supplier/update';

//customer
$route['customer'] = 'Users/customer';

//customer
$route['supplier'] = 'Users/supplier';

//configuration
// menu
$route['configuration/menu'] = 'Configuration/menu';
$route['configuration/menu/category-insert'] = 'Configuration/menu/category_insert';