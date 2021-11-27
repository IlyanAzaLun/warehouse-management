<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_signin(get_class($this));
		$this->load->model('M_users');
		$this->load->model('M_role');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
	}
	public function index(){
		$this->data['plugins'] = array(
			'css' => [
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'),
			],
			'js' => [
				base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'),
				base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'),
			],
			'module' => [
				base_url('assets/pages/configuration/role/index.js'),
			],
		);
		$this->data['title'] = 'Role management';
		$this->data['roles'] = $this->db->get('tbl_role')->result_array();
		$this->load->view('configuration/role/index', $this->data);
		$this->load->view('configuration/role/modals', $this->data);
		
	}

	public function data()
	{
		$this->db->select(
			'category.category_id category_id
			,category.category_name
		');
		$this->db->where('role_id', $this->input->post('data'));
		$this->db->join('tbl_user_menu_category category', 'category.category_id=access.category_id', 'left');
		$this->data['information'] = $this->db->get('tbl_user_access_menu access')->result_array();
		$this->load->view('configuration/role/data', $this->data);
	}

	public function category_insert()
	{
		$this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
		if($this->input->post('role') != true){
			$this->form_validation->set_rules('role', 'Role', 'required|trim');
		}
		if ($this->form_validation->run() == false) {
			Flasher::setFlash('info', 'error', 'Failed', ' something worng to update data! '.validation_errors());
            redirect('configuration/role');
		}else{
			try {
				echo "<pre>";
				var_dump($this->M_role->role_category_insert($this->input->post())); 
				echo "</pre>";
				die();
				Flasher::setFlash('info', 'success', 'Success', ' congratulation you already added new data!');
				redirect('configuration/role');
			} catch (Exception $e) {
				var_dump($e);
			}
		}


	}

}