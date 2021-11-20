<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class User extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_menu');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
    }
     
    public function getuser()
    {
     echo json_encode($this->db->get_where('tbl_user_information', ['user_id'=>$this->input->post('data')])->row_array());
    }
    
    public function update()
    {
    	$this->form_validation->set_rules('user_id', 'Code item', 'required|trim');
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect('supplier');
          }else{

               $this->db->where('user_id', htmlspecialchars($this->input->post('user_id', true)));
               $this->db->update('tbl_user_information', $this->input->post());
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
               redirect('supplier');
          }
    }

    public function delete()
    {
    	$this->form_validation->set_rules('user_id', 'Code item', 'required|trim');
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect('supplier');
          }else{
               
               $this->db->where('user_id', htmlspecialchars($this->input->post('user_id', true)));
               $this->db->delete('tbl_user_information');
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
               redirect('supplier');
          }
    }

}