<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Invoice extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_menu');
		$this->load->model('M_invoice');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
    }
}