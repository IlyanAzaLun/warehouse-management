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
          $this->load->model('M_role');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
    }
     
    public function getuser()
    {
     echo json_encode($this->db->get_where('tbl_user_information', ['user_id'=>$this->input->post('data')])->row_array());
    }
    
    public function update()
    {
    	     $this->form_validation->set_rules('user_id', 'Code item', 'required|trim');

          $this->info = array(
               'user_fullname'      =>  $this->input->post('user_fullname', true),
               'owner_name'         =>  ($this->input->post('owner_name', true))?$this->input->post('owner_name', true):null,
               'user_address'       =>  $this->input->post('user_address', true),
               'village'            =>  $this->input->post('village', true),
               'sub-district'       =>  $this->input->post('sub-district', true),
               'district'           =>  $this->input->post('district', true),
               'province'           =>  $this->input->post('province', true),
               'zip'                =>  $this->input->post('zip', true),
               'user_contact_phone' =>  $this->input->post('user_contact_phone', true),
               'user_contact_email' =>  $this->input->post('user_contact_email', true),
               'type_id'            =>  $this->input->post('type_id', true),
               'role_id'            =>  $this->input->post('role_id', true),
               'note'               =>  $this->input->post('note', true),
          );
          $this->user = array(
               'user_fullname'      =>  $this->input->post('user_fullname', true),
               'role_id'            =>  $this->input->post('role_id', true),
               'is_active'          =>  ($this->input->post('is_active', true))?1:0,
          );

          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect($_SERVER['HTTP_REFERER']);
          }else{
               if($this->db->get_where('tbl_user_information', array('user_id' => $this->input->post('user_id', true)))->num_rows() <= 0){
                    $this->info['user_id'] = $this->input->post('user_id', true);
                    $this->db->insert('tbl_user_information', $this->info);

                    $this->db->where('user_id', $this->input->post('user_id', true));
                    $this->db->update('tbl_user', $this->user);
               }else{
                    $this->db->where('user_id', $this->input->post('user_id'));
                    $this->db->update('tbl_user_information', $this->info);
                    
                    $this->db->where('user_id', $this->input->post('user_id'));
                    $this->db->update('tbl_user', $this->user);
               }
          }
          Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
          redirect($_SERVER['HTTP_REFERER']);
    }

    private function _insert_if_null_info_user()
    {
         // code...
    }

    public function delete()
    {
    	$this->form_validation->set_rules('user_id', 'Code item', 'required|trim');
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect($_SERVER['HTTP_REFERER']);
          }else{
               
               $this->db->where('user_id', htmlspecialchars($this->input->post('user_id', true)));
               $this->db->delete('tbl_user_information');
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
               redirect($_SERVER['HTTP_REFERER']);
          }
    }

}