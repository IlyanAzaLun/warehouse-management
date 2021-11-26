<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                 = 'welcome/dashboard';
$route['404_override']                       = 'welcome';
$route['translate_uri_dashes']               = FALSE;

$route['dashboard']                          = 'welcome/dashboard';

// REST API
$route['(:any)/API/item']                   = 'REST/Items';
$route['(:any)/API/user']                   = 'REST/User';
$route['(:any)/API/order']                  = 'REST/order';
$route['(:any)/API/invoice']                = 'REST/Invoice';

//INVENTORY
// item
$route['items']                              = 'Items';
$route['item/insert']                        = 'Items/insert';
$route['items/get-item-code']                = 'Items/get_code';
$route['items/get-item']                     = 'Items/get_item';
$route['item/delete']                        = 'Items/delete';
$route['item/update']                        = 'Items/update';
$route['(:any)/items/get-data']              = 'Items/get_item_invoice';

// item stock
$route['stocks']                             = 'Stock';
$route['stocks/get-item']                    = 'Stock/getitem';
$route['stocks/get-history']                 = 'Stock/gethistory';

//INVOICE
$route['(:any)/invoice/select']              = 'Invoices/selling/select_invoice';
$route['(:any)/invoice/update']              = 'Invoices/selling/update_invoice';

//sale
$route['sale']                               = 'Invoices/selling';
$route['sale/info']                          = 'Invoices/Selling/info_invoice';
$route['sale/user-info']                     = 'Invoices/Selling/user_info';

//purchase
$route['purchase']                           = 'Invoices/purchasing';
$route['purchase/info']                      = 'Invoices/purchasing/info_invoice';
$route['purchase/user-info']                 = 'Invoices/purchasing/user_info';

//USER;
$route['user/delete']                        = 'Users/supplier/delete';
$route['user/update']                        = 'Users/supplier/update';
$route['(:any)/user/select']                 = 'Users/supplier/getuser';

//supplier
$route['supplier']                           = 'Users/supplier';

//customer
$route['customer']                           = 'Users/customer';


//configuration
// menu
$route['configuration/menu']                 = 'Configuration/menu';
$route['configuration/menu/category-insert'] = 'Configuration/menu/category_insert';