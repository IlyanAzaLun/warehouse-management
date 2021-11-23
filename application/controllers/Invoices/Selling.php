<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/Invoice.php';
class Selling extends Invoice
{

     public function __construct()
     {
          parent::__construct();
     }

     public function index(){
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
                    base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.structure.min.css'),
                    base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.theme.min.css'),
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
                    base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js'),
               ],
               'module' => [
                    base_url('assets/pages/invoice/index.js'),
               ],
          );
          $this->data['title'] = 'Manajemen pemesanan';
          $this->data['invoices'] = $this->M_invoice->invoice_select();
          $this->data['categorys'] = $this->M_menu->menu_category_select();

          $this->form_validation->set_rules('item_name[]', 'Item name', 'required|trim');
          $this->form_validation->set_rules('quantity[]', 'Quantity', 'required|trim');
          $this->form_validation->set_rules('unit[]', 'Unit', 'required|trim');
          if ($this->form_validation->run()==false) {
               $this->load->view('invoice/index', $this->data);
               $this->load->view('invoice/modals');
          }else{
               $this->add_invoice();
               die();
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
               redirect('invoice');
          }
     }

     public function user_info()
     {
          if ($this->input->post('request')) {
               if ($this->input->post('data')) {
                    $this->db->where('role_id', '752c0ad8-4925-11ec-8cc8-1be21be013bc');
                    $this->db->where('user_fullname', $this->input->post('data'));
                    $this->data = $this->db->get('tbl_user_information')->row_array();
                    if ($this->data) {
                         echo json_encode($this->data);
                    }else{
                         echo json_encode($data = array(
                              'user_id' => '', 
                              'user_contact_phone' => '', 
                              'user_address' => '', 
                         ));
                    }
               }else{
                    $this->db->where('role_id', '752c0ad8-4925-11ec-8cc8-1be21be013bc');
                    echo json_encode($this->db->get('tbl_user_information')->result_array());
               }
          }
     }

     public function items()
     {
          if ($this->input->post('request')) {
               if ($this->input->post('data')) {
                    $this->data = $this->db->get_where('tbl_item', array('item_name' => $this->input->post('data')))->row_array();
                    if ($this->data) {
                         echo json_encode($this->data);
                    }else{
                         echo json_encode($data = array(
                              'user_id' => '', 
                              'user_contact_phone' => '', 
                              'user_address' => '', 
                         ));
                    }
               }else{
                    echo json_encode($this->db->get('tbl_item')->result_array());
               }
          }
     }

     public function update()
     {
          $this->form_validation->set_rules('invoice_code', 'Code invoice', 'required|trim');
          $this->form_validation->set_rules('invoice_name', 'invoice name', 'required|trim');
          $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
          $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
          $this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim|integer');
          $this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|integer|greater_than['.$this->input->post('capital_price').']', array('greater_than' => 'The %s must greater than Capital price'));
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to update data! '.validation_errors());
               redirect('invoice');
          }else{
               $this->data = [
                    'invoice_code'     => htmlspecialchars($this->input->post('invoice_code', true)),
                    'invoice_name'     => htmlspecialchars($this->input->post('invoice_name', true)),
                    'quantity'      => htmlspecialchars($this->input->post('quantity', true)),
                    'unit'          => htmlspecialchars($this->input->post('unit', true)),
                    'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
                    'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
               ];
               $this->M_invoice->invoice_update($this->data);
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
               redirect('invoice');
          }
     }
     public function delete()
     {
          $this->form_validation->set_rules('invoice_code', 'Code invoice', 'required|trim');
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect('invoice');
          }else{
               $this->data = [
                    'invoice_code'     => htmlspecialchars($this->input->post('invoice_code', true)),
               ];
               $this->M_invoice->invoice_delete($this->data);
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
               redirect('invoice');
          }    
     }

     public function info_invoice()
     {
          $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id', true));
          $this->data['orders'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
          $this->data['title'] = 'Detail informasi penjualan';
          $this->load->view('invoice/info-invoice', $this->data);

     }
}