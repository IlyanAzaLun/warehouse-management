<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_users');
	}
	public function index(){
		is_signout();
		$this->data['title'] = 'Sign in';
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run()==false) {

			$this->load->view('auth/signin', $this->data);
		}else{
			$this->_validation();
		}
	}
	private function _validation()
	{
		$user = $this->db->get_where('tbl_user', [
			'user_email' => $this->input->post('email', true)
		])->row_array();
		if($user AND password_verify($this->input->post('password', true), $user['user_password'])){
			if ($user['is_active']) {
				$this->session->set_userdata([
					'fullname'=>$user['user_fullname'],
					'email'=>$user['user_email'],
					'role_id'=>$user['role_id']
				]);
				Flasher::setFlash('info', 'success', 'Success', ' congratulation you already signin!');
				redirect('dashboard');
			}else{
				Flasher::setFlash('info', 'warning', 'Warning', ' email is not activated!');
				redirect('auth');
			}
		}else{
			Flasher::setFlash('info', 'warning', 'Warning', ' email is not registered!');
			redirect('auth');
		}
	}
	public function signup(){
		$this->form_validation->set_rules('name', 'Full name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[tbl_user.user_email]',[
			'is_unique' => 'This email has alredy registerd!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repassword]');
		$this->form_validation->set_rules('repassword', 'Re-password', 'required|trim|matches[password]');
		if ($this->form_validation->run()==false) {
			$this->data['title'] = 'Sign up';
			$this->load->view('auth/signup', $this->data);
		}else{
			$this->data = [
				'user_fullname' => htmlspecialchars($this->input->post('name', true)),
				'user_email' 	=> htmlspecialchars($this->input->post('email', true)),
				'user_password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			];
			$this->M_users->user_insert($this->data);
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to create account!');
			redirect('auth');
		}
	}
	public function signout()
	{
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		Flasher::setFlash('info', 'success', 'Success', ' congratulation you already signout!');
		redirect('auth');
	}
	public function blocked()
	{
		$this->data['title'] = '500';
		$this->load->view('components/header', $this->data);
		$this->load->view('components/500', $this->data);
	}
}
