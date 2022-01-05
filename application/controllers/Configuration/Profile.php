<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/User.php';
class Profile extends User
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

     public function index()
     {
          $this->form_validation->set_rules('user_id', 'User', 'required|trim');
          if ($this->form_validation->run()==false) {
               $this->data['title'] = 'Profile';
               $this->load->view('user/users/profile', $this->data);
          }else{
               $config['allowed_types'] = 'jpg|jpeg|png';
               $config['upload_path']   = 'assets/images/';
               $config['file_name']     = 'user-'.date("YMD").time();
               $this->load->library('upload', $config);
               if (@$_FILES['user_image']) {
                    //upload
                    if ($this->upload->do_upload('user_image')) {
						if ($this->data['user']['user_image']!="assets/images/default.jpg") {
							unlink($this->data['user']['user_image']);
						}
						$gbr = $this->upload->data();
						//Compress Image
						$config['image_library']='gd2';
						$config['source_image']='assets/images/'.$gbr['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 100;
						$config['new_image']= 'assets/images/'.$gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						$this->request['user_image'] = $config['upload_path'].$this->upload->data('file_name');
						$this->request['user_id'] = $this->data['user']['user_id'];
						$this->M_users->user_update($this->request);
						Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
						redirect('profile');    
                    }
                    //update ./
               }else{
                    //add more do something, to update data, if form no image
                    Flasher::setFlash('info', 'error', 'Failed', ' kesalahan pada informasi!');
                    redirect('profile');    
               }    
          }
     }

     public function update_password()
     {
          $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
          $this->form_validation->set_rules('re-password', 'Re-password', 'required|trim|matches[password]');
          if ($this->form_validation->run()==false) {
               $this->index();
          }else{
               $this->data['update'] = array(
                    'user_id'       => $this->data['user']['user_id'],
                    'user_password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
               );
               $this->M_users->user_update($this->data['update']);
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
               redirect('profile');    
          }
     }
}