<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome/dashboard';
$route['404_override'] = 'welcome';
$route['translate_uri_dashes'] = false;

$route['dashboard'] = 'welcome/dashboard';

// REST API
$route['(:any)/API/item'] = 'REST/Items';
$route['(:any)/API/users'] = 'REST/User';
$route['(:any)/(:any)/API/customer'] = 'REST/Customer'; // dont rewrite this ! use in wareshoues
$route['(:any)/API/roles'] = 'REST/Roles';
$route['(:any)/API/order'] = 'REST/order';
$route['(:any)/(:any)/API/order'] = 'REST/order';
// $route['(:any)/queue/API/order']            = 'REST/order'; // dont rewrite this ! use in wareshoues
$route['(:any)/API/invoice'] = 'REST/Invoice';

//INVENTORY
// item
$route['items'] 				= 'Items';
$route['item/insert'] 			= 'Items/insert';
$route['item/import'] 			= 'Items/import';
$route['item/history']			= 'Items/history';
$route['item/delete'] 			= 'Items/delete';
$route['item/update'] 			= 'Items/update';
$route['items/get-item-code'] 	= 'Items/get_code';

// item stock
$route['stocks'] 				= 'Stock';
$route['stocks/restock'] 		= 'Stock/restock';

//Warehouse
$route['warehouse/info'] 							  = 'Warehouse/info';
$route['warehouse/queue'] 							  = 'Warehouse/queue';
$route['warehouse/status'] 							  = 'Warehouse/update_status';
$route['warehouse/cancel'] 							  = 'Warehouse/cancel';
$route['warehouse/status-return'] 					  = 'Warehouse/update_status_return';
$route['(:any)/(:any)/warehouse/notification']		  = 'Warehouse/notification';
$route['(:any)/(:any)/warehouse/notification-change'] =	'Warehouse/notification_change';
$route['(:any)/(:any)/warehouse/item'] 				  = 'Warehouse/list_item'; // dont change this

//Shipping
$route['shipping/info'] 							 = 'Shipping/info';
$route['shipping/queue'] 							 = 'Shipping/queue';
$route['shipping/status'] 							 = 'Shipping/update_status';
$route['shipping/return'] 							 = 'Shipping/return';
$route['shipping/cancel'] 							 = 'Shipping/cancel';
$route['(:any)/(:any)/shipping/notification'] 		 = 'Shipping/notification';
$route['(:any)/(:any)/shipping/notification-change'] = 'Shipping/notification_change';
$route['(:any)/(:any)/shipping/item'] 				 = 'Shipping/list_item'; // dont change this

//INVOICE
$route['(:any)/invoice/select'] = 'Invoices/purchasing/select_invoice';
$route['(:any)/invoice/cancel'] = 'Invoices/purchasing/cancel_invoice';
$route['(:any)/invoice/update'] = 'Invoices/purchasing/update_invoice';

//sale
$route['sale'] = 'Invoices/selling';
$route['sale/info'] = 'Invoices/Selling/info_invoice';
$route['sale/user-info'] = 'Invoices/Selling/user_info';
$route['sale/status'] = 'Invoices/Selling/update_status_invoice';

//purchase
$route['purchase'] = 'Invoices/purchasing';
$route['purchase/info'] = 'Invoices/purchasing/info_invoice';
$route['purchase/update'] = 'Invoices/purchasing/update';
$route['purchase/user-info'] = 'Invoices/purchasing/user_info';
$route['purchase/order/remove'] = 'Invoices/purchasing/invoice_order_remove';

//USER;
$route['user/delete'] = 'Users/supplier/delete';
$route['user/update'] = 'Users/supplier/update';
$route['(:any)/user/select'] = 'Users/supplier/getuser';

//users
$route['users'] = 'Users/users';
$route['profile'] = 'Users/users/profile';
$route['profile/update-password'] = 'Users/users/update_password';

//supplier
$route['supplier'] = 'Users/supplier';

//customer
$route['customer'] = 'Users/customer';
$route['customer/import'] = 'Users/customer/import';

//configuration
// menu
$route['configuration/menu'] = 'Configuration/menu';
$route['configuration/menu/category-insert'] =
    'Configuration/menu/category_insert';

//role
$route['configuration/role'] = 'Configuration/role';
$route['configuration/role/data'] = 'Configuration/role/data';
