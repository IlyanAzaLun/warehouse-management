<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_users');
		$this->load->model('M_menu');
		$this->load->model('M_role');
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
				base_url('assets/pages/configuration/menu/index.js'),
			],
		);
		$this->data['title']     = 'Menu management';
		$this->data['user']      = $this->M_users->user_select($this->session->userdata('email'));
		$this->data['menus']     = $this->M_menu->menu_select();
		$this->data['categorys'] = $this->M_menu->menu_category_select();
		$this->data['roles']     = $this->M_role->role_select();

		$this->form_validation->set_rules('menu', 'Menu name', 'required|trim');
		$this->form_validation->set_rules('category_id', 'Category menu', 'required|trim');
		$this->form_validation->set_rules('url', 'Url menu', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon menu', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('configuration/menu/index', $this->data);
			$this->load->view('configuration/menu/modals', $this->data);
		}else{
			$this->data = [
				'title'           => htmlspecialchars($this->input->post('menu', true)),
				'category_id'     => htmlspecialchars($this->input->post('category_id', true)),
				'url'             => htmlspecialchars($this->input->post('url', true)),
				'parent_id'       => htmlspecialchars($this->input->post('parent_id', true)),
				'menu_controller' => htmlspecialchars($this->input->post('menu_controller', true)),
				'icon'            => htmlspecialchars($this->input->post('icon', true)),
				'is_active'       => htmlspecialchars($this->input->post('is_active', true)),
			];

			echo "<b>Information! under maintenance</b>";
			echo "<pre>";
			foreach ($this->input->post('role') as $key => $role) {
				echo $key;
			}
			echo "</pre>";
			// die();
			
			if ($this->M_menu->menu_insert($this->data)) {
				Flasher::setFlash('info', 'success', 'Success', ' congratulation you already added new data!');
				redirect('configuration/menu');
			};
		}
	}

	public function category_insert()
	{
		$this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
		if($this->input->post('role') != true){
			$this->form_validation->set_rules('role', 'Role', 'required|trim');
		}
		if ($this->form_validation->run() == false) {
			Flasher::setFlash('info', 'error', 'Failed', ' something worng to update data! '.validation_errors());
            redirect('configuration/menu');
		}else{
			try {
				echo "<pre>";
				var_dump($this->M_menu->menu_category_insert($this->input->post())); 
				echo "</pre>";
				die();
				Flasher::setFlash('info', 'success', 'Success', ' congratulation you already added new data!');
				redirect('configuration/menu');
			} catch (Exception $e) {
				var_dump($e);
			}
		}


	}

}