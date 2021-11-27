<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/User.php';
class Users extends User
{
     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $this->data['title'] = 'Manajemen pengguna';
          $this->data['suppliers'] = $this->M_users->user_select();
          $this->data['plugins'] = array(
               'css' => [
                    base_url('assets/AdminLTE-3.0.5/plugins/jsgrid/jsgrid.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/jsgrid/jsgrid-theme.min.css'),
               ],
               'js' => [
                    base_url('assets/AdminLTE-3.0.5/plugins/jsgrid/jsgrid.min.js'),
               ],
               'module' => [
                    base_url('assets/pages/user/users/index.js'),
               ],
          );

          $this->form_validation->set_rules('user_fullname', 'Nama penyedia barang', 'required|trim');
          $this->form_validation->set_rules('owner_name', 'Nama pemeilik penyedia', 'required|trim');
          $this->form_validation->set_rules('user_address', 'Alamat', 'required|trim');
          $this->form_validation->set_rules('village', 'Desa', 'required|trim');
          $this->form_validation->set_rules('sub-district', 'Kecamatan', 'required|trim');
          $this->form_validation->set_rules('district', 'Kabupaten', 'required|trim');
          $this->form_validation->set_rules('province', 'Provnsi', 'required|trim');
          $this->form_validation->set_rules('zip', 'Kode pos', 'required|trim');
          $this->form_validation->set_rules('user_contact_phone', 'Kontak Telepon', 'required|trim');
          $this->form_validation->set_rules('user_contact_email', 'Kontak Email', 'required|trim|valid_email');

          if ($this->form_validation->run()==false) {
               $this->load->view('user/users/index', $this->data);
               $this->load->view('user/users/modals');
          }else{
               $this->data = [
                    'user_fullname'      => htmlspecialchars($this->input->post('user_fullname', true)),
                    'user_address'       => htmlspecialchars($this->input->post('user_address', true)),
                    'owner_name'         => htmlspecialchars($this->input->post('owner_name', true)),
                    'user_address'       => htmlspecialchars($this->input->post('user_address', true)),
                    'village'            => htmlspecialchars($this->input->post('village', true)),
                    'sub-district'       => htmlspecialchars($this->input->post('sub-district', true)),
                    'district'           => htmlspecialchars($this->input->post('district', true)),
                    'province'           => htmlspecialchars($this->input->post('province', true)),
                    'zip'                => htmlspecialchars($this->input->post('zip', true)),
                    'user_contact_phone' => htmlspecialchars($this->input->post('user_contact_phone', true)),
                    'user_contact_email' => htmlspecialchars($this->input->post('user_contact_email', true)),
                    'type_id'            => htmlspecialchars($this->input->post('type_id', true)),
                    'role_id'            => '5347d8a4-4925-11ec-8cc8-1be21be013bc',
                    'note'               => htmlspecialchars($this->input->post('note', true)),
               ];
               try {

                    $this->M_users->user_info_insert($this->data, 'Supplier'); // this id for role on tbl_role
                    Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
                    redirect('users');    
               } catch (Exception $e) {
                    Flasher::setFlash('info', 'error', 'Failed', '  to entry data!, '.$e);
                    redirect('users');
               }
          }
     }
}