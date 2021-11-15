<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_users');
	}
	public function index(){
		$this->load->view('welcome_message');
	}

	public function dashboard()
	{
		$this->data['plugins'] = array(
			'css' => [
			],
			'js' => [
			],
			'module' => [
			],
		);
		$this->data['title'] = 'Dashboard';
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
		$this->load->view('dashboard', $this->data);
	}
}
