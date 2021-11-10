<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function is_signin($controller)
{
	$ci =& get_instance();
	if (!$ci->session->userdata('fullname')) {
		redirect('auth');
	}else{
		$role_id = $ci->session->userdata('role_id');
		$menu = $ci->db->get_where('tbl_user_menu', ['menu_controller' => $controller])->row_array();
		$userAccess = $ci->db->get_where('tbl_user_access_menu', [
			'role_id' => $role_id, 
			'category_id' => $menu['category_id']
		]);
		if($userAccess->num_rows()<1){
			redirect('auth/blocked');
		}

	}
}