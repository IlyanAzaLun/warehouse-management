<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_label_menu()
{
	$ci =& get_instance();
	$ci->db->select(
	  `menu_category`.`category_id`,
	  `menu_category`.`category_name`,
	);
	$ci->db->join('tbl_user_access_menu user_access_menu', 'menu_category.category_id = user_access_menu.category_id', 'right');
	$ci->db->where('user_access_menu.role_id', $ci->session->userdata('role_id'));
	$ci->db->order_by('user_access_menu.category_id', 'ASC');
	return $ci->db->get('tbl_user_menu_category menu_category')->result_array();
}

function get_menu($parent)
{
	$ci =& get_instance();
	$ci->db->where('category_id', $parent);
	$ci->db->where('is_active', 1);
	return $ci->db->get('tbl_user_menu')->result_array();
}

function get_submenu($parent)
{
	$ci =& get_instance();
	$ci->db->where('parent_id', $parent);
	$ci->db->where('is_active', 1);
	return $ci->db->get('tbl_user_menu')->result_array();
}

function convertToMoney($number)
{
	return strrev(implode('.',str_split(strrev(strval($number)),3)));
}