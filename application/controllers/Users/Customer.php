<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/User.php';
class Customer extends User
{
     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $this->data['title'] = 'Manajemen pelanggan';
          $this->data['customers'] = $this->M_users->user_info_select(false, 'Customer');

          
          $this->data['plugins'] = array(
               'css' => [
                    base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'),
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
                    base_url('assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'),
               ],
               'module' => [
                    base_url('assets/pages/user/customer/index.js'),
               ],
          );

          $this->form_validation->set_rules('user_fullname', 'Nama penyedia barang', 'required|trim');
          $this->form_validation->set_rules('user_address', 'Alamat', 'required|trim');
          $this->form_validation->set_rules('village', 'Desa', 'required|trim');
          $this->form_validation->set_rules('sub-district', 'Kecamatan', 'required|trim');
          $this->form_validation->set_rules('district', 'Kabupaten', 'required|trim');
          $this->form_validation->set_rules('province', 'Provnsi', 'required|trim');
          $this->form_validation->set_rules('zip', 'Kode pos', 'required|trim');
          $this->form_validation->set_rules('user_contact_phone', 'Kontak Telepon', 'required|trim');
          $this->form_validation->set_rules('user_contact_email', 'Kontak Email', 'required|trim|valid_email');
          $this->form_validation->set_rules('type_id', 'Kategori', 'required|trim');

          if ($this->form_validation->run()==false) {
               $this->load->view('user/customer/index', $this->data);
               $this->load->view('user/customer/modals');
          }else{
               try {

                    $this->M_users->user_info_insert($this->input->post(), '752c0ad8-4925-11ec-8cc8-1be21be013bc'); // this id for role on tbl_role
                    Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
                    redirect('customer');    
               } catch (Exception $e) {
                    Flasher::setFlash('info', 'error', 'Failed', '  to entry data!, '.$e);
                    redirect('customer');
               }
          }
     }
}