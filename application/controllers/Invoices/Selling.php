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
                    base_url('assets/pages/invoice/sale/index.js'),
               ],
          );
          $this->data['title'] = 'Manajemen penjualan';
          $this->data['invoices'] = $this->M_invoice->invoice_select(false, 'INV/SEL/');
          $this->data['categorys'] = $this->M_menu->menu_category_select();

          $this->form_validation->set_rules('item_name[]', 'Item name', 'required|trim');
          $this->form_validation->set_rules('quantity[]', 'Quantity', 'required|trim');
          $this->form_validation->set_rules('unit[]', 'Unit', 'required|trim');
          if ($this->form_validation->run()==false) {
               $this->load->view('invoice/selling/index', $this->data);
               $this->load->view('invoice/selling/modals');
          }else{
               $this->add_invoice();
          }
     }

     protected function add_invoice()
     {
          $this->db->group_by('order_id');
          $order_id   = sprintf("OR/%010s", $this->db->get('tbl_order')->num_rows()+1);
          $this->db->like('invoice_id', '/INV/SEL/'.date("my"), 'before');
          $invoice_id = sprintf("%04s/INV/SEL/", $this->db->get('tbl_invoice')->num_rows()+1).date("my");

          foreach ($this->input->post('item_code', true) as $key => $value) {
               $this->request['order']['order_id'][$key]           = $order_id;
               $this->request['order']['item_code'][$key]          = $this->input->post('item_code', true)[$key];
               $this->request['order']['item_capital_price'][$key] = $this->input->post('item_capital_price', true)[$key];
               $this->request['order']['item_selling_price'][$key] = $this->input->post('item_selling_price', true)[$key];
               $this->request['order']['item_quantity'][$key]      = (-(int)$this->input->post('quantity', true)[$key]);
               $this->request['order']['item_unit'][$key]          = $this->input->post('unit', true)[$key];
               $this->request['order']['rebate_price'][$key]       = $this->input->post('rebate_price', true)[$key];
               $this->request['order']['status_in_out'][$key]      = 'OUT';
               $this->request['order']['user_id'][$key]            = $this->input->post('user_id', true);
               $this->request['order']['date'][$key]               = time();

          }
          $this->request['order_id']       = $order_id;
          $this->request['user_id']        = $this->input->post('user_id', true);
          $this->request['fullname']       = $this->input->post('fullname', true);
          $this->request['contact_number'] = $this->input->post('contact_number', true);
          $this->request['address']        = $this->input->post('address', true);
          $this->request['sub_total']      = $this->input->post('sub_total', true);
          $this->request['discount']       = $this->input->post('discount', true);
          $this->request['shipping_cost']  = $this->input->post('shipping_cost', true);
          $this->request['other_cost']     = $this->input->post('other_cost', true);
          $this->request['grand_total']    = $this->input->post('grand_total', true);
          $this->request['note']           = $this->input->post('note', true);
          $this->request['status_payment'] = ($this->input->post('status_payment', true))?1:0;

          $this->invoice = [
               'invoice_id'              => $invoice_id,
               'date'                    => time(),
               'date_due'                => time()+(7 * 24 * 60 * 60), //7 days; 24 hours; 60 mins; 60 secs
               'to_customer_destination' => $this->request['user_id'],
               'order_id'                => $this->request['order_id'],
               'sub_total'               => $this->request['sub_total'],
               'discount'                => $this->request['discount'],
               'shipping_cost'           => $this->request['shipping_cost'],
               'other_cost'              => $this->request['other_cost'],
               'grand_total'             => $this->request['grand_total'],
               'status_active'           => 1,
               'status_item'             => 0,
               'status_validation'       => 0,
               'status_payment'          => $this->request['status_payment'],
               'status_settlement'       => $this->request['status_payment'],
               'user'                    => $this->session->userdata('fullname'),
               'note'                    => $this->request['note']
          ];
          $this->M_order->order_insert($this->request['order']); // insert to tbl_order, insert to tbl_history, and update item
          $this->M_invoice->invoice_insert($this->invoice);
          Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
          redirect('sale');
     }

     public function user_info() // get information customer
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
                              'user_id'            => '', 
                              'user_contact_phone' => '', 
                              'user_address'       => '', 
                         ));
                    }
               }else{
                    $this->db->where('role_id', '752c0ad8-4925-11ec-8cc8-1be21be013bc');
                    echo json_encode($this->db->get('tbl_user_information')->result_array());
               }
          }
     }

     public function items() // find item, this parent on invoice
     {
          if ($this->input->post('request')) {
               if ($this->input->post('data')) {
                    $this->data = $this->db->get_where('tbl_item', array('item_name' => $this->input->post('data')))->row_array();
                    if ($this->data) {
                         echo json_encode($this->data);
                    }else{
                         echo json_encode($data = array(
                              'user_id'            => '', 
                              'user_contact_phone' => '', 
                              'user_address'       => '', 
                         ));
                    }
               }else{
                    echo json_encode($this->db->get('tbl_item')->result_array());
               }
          }
     }
     public function info_invoice() // show information/detail about invoice, on list invoice
     {
          $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id', true));
          if ($this->data['invoice']) {
               $this->data['orders'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
               $this->data['title']  = 'Detail informasi penjualan';
               $this->load->view('invoice/selling/info-invoice', $this->data);
          }else{
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to select data');
               redirect('sale');
          }
     }
     public function update_status_invoice() // change status invoice
     {
          $this->form_validation->set_rules('invoice_id', 'Code invoice', 'required|trim');
          $this->form_validation->set_rules('invoice_status', 'Status invoice', 'required|trim');
          if ($this->form_validation->run()==false) {
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
               redirect('sale');
          }else{
               if ($this->input->post('invoice_status') == "status_validation") {
                    //status item 1
                    $this->request['status_validation'] = $this->_status_check(1);
                    $this->db->where('invoice_id', $this->input->post('invoice_id', true));
                    $this->db->update('tbl_invoice', $this->request);
               }else{
                    // status validation 3
                    $this->request['status_item'] = $this->_status_check(3);
                    $this->db->where('invoice_id', $this->input->post('invoice_id', true));
                    $this->db->update('tbl_invoice', $this->request);
               }
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
               redirect('sale');
          }
     }
     private function _status_check($limit) // check status infoice, user in update status..
     {
          if ($this->db->get_where('tbl_invoice', array('invoice_id'=>$this->input->post('invoice_id')))->row_array()[$this->input->post('invoice_status')] == $limit) {
               return 0;
          }else{
               return ++$this->db->get_where('tbl_invoice', array('invoice_id'=>$this->input->post('invoice_id')))->row_array()[$this->input->post('invoice_status')];
          }
     }
}