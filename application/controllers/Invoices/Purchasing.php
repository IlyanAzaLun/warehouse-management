<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/Invoice.php';
class Purchasing extends Invoice
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
                    base_url('assets/pages/invoice/purchase/index.js'),
               ],
          );
          $this->data['title'] = 'Manajemen pembelian';
          $this->data['invoices'] = $this->M_invoice->invoice_select(false, 'INV/PUR/');
          $this->data['categorys'] = $this->M_menu->menu_category_select();

          $this->form_validation->set_rules('item_name[]', 'Item name', 'required|trim');
          $this->form_validation->set_rules('quantity[]', 'Quantity', 'required|trim');
          $this->form_validation->set_rules('unit[]', 'Unit', 'required|trim');
          if ($this->form_validation->run()==false) {
               $this->load->view('invoice/purchasing/index', $this->data);
               $this->load->view('invoice/purchasing/modals');
          }else{
               $this->add_invoice();
          }
     }
     protected function add_invoice() // FIX THIS METHOD TO MORE BETTER, 
     {
          $this->db->like('order_id', '/ORD/PUR/'.date("my"), 'before');
          $order_id   = sprintf("%04s/ORD/PUR/", $this->db->get('tbl_order')->num_rows()+1).date("my");

          $this->db->like('invoice_id', '/INV/PUR/'.date("my"), 'before');
          $invoice_id = sprintf("%04s/INV/PUR/", $this->db->get('tbl_invoice')->num_rows()+1).date("my");

          foreach ($this->input->post('item_code', true) as $key => $value) {
               $this->request['order']['order_id'][$key]           = $order_id;
               $this->request['order']['item_code'][$key]          = $this->input->post('item_code', true)[$key];
               $this->request['order']['item_capital_price'][$key] = $this->input->post('item_capital_price', true)[$key];
               $this->request['order']['item_selling_price'][$key] = $this->input->post('item_selling_price', true)[$key];
               $this->request['order']['item_quantity'][$key]      = $this->input->post('quantity', true)[$key];
               $this->request['order']['item_unit'][$key]          = $this->input->post('unit', true)[$key];
               $this->request['order']['rebate_price'][$key]       = $this->input->post('rebate_price', true)[$key];
               $this->request['order']['status_in_out'][$key]      = 'IN';
               $this->request['order']['user_id'][$key]            = $this->input->post('user_id', true);
               $this->request['order']['date'][$key]               = time();

          }

          $this->invoice = [
               'invoice_id'              => $invoice_id,
               'date'                    => time(),
               'date_due'                => time()+(7 * 24 * 60 * 60), //7 days; 24 hours; 60 mins; 60 secs
               'to_customer_destination' => $this->input->post('user_id', true),
               'order_id'                => $order_id,
               'sub_total'               => ($this->input->post('sub_total', true))?$this->input->post('sub_total', true):0,
               'discount'                => ($this->input->post('discount', true))?$this->input->post('discount', true):0,
               'shipping_cost'           => ($this->input->post('shipping_cost', true))?$this->input->post('shipping_cost', true):0,
               'other_cost'              => ($this->input->post('other_cost', true))?$this->input->post('other_cost', true):0,
               'grand_total'             => ($this->input->post('grand_total', true))?$this->input->post('grand_total', true):0,
               'status_active'           => 1,
               'status_item'             => 0,
               'status_validation'       => 0,
               'status_payment'          => ($this->input->post('status_payment', true))?1:0,
               'status_settlement'       => ($this->input->post('status_payment', true))?1:0,
               'user'                    => $this->session->userdata('fullname'),
               'note'                    => ($this->input->post('note', true))?$this->input->post('note', true):join(', ', $this->request['order']['item_code'])
          ];
          $this->M_order->order_insert_history_update_item($this->request['order']); // insert to tbl_order, insert to tbl_history, and update item
          $this->M_invoice->invoice_insert($this->invoice);
          
          Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
          redirect($_SERVER['HTTP_REFERER']);
     }

     public function info()
     {
          $this->data['title'] = 'Invoice';
          $this->load->view('invoice/purchasing/info-invoice', $this->data);
     }

     public function user_info()
     {
          if ($this->input->post('request')) {
               if ($this->input->post('data')) {
                    $this->db->where('role_id', '5347d8a4-4925-11ec-8cc8-1be21be013bc');
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
                    $this->db->where('role_id', '5347d8a4-4925-11ec-8cc8-1be21be013bc');
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

     public function update()
     {
          
          $this->data['plugins'] = array(
               'module' => [
                    base_url('assets/pages/invoice/purchase/update.js'),
               ],
          );
          $this->form_validation->set_rules('invoice_code', 'Code invoice', 'required|trim');
          $this->form_validation->set_rules('invoice_name', 'invoice name', 'required|trim');
          $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
          $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
          $this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim|integer');
          $this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|integer|greater_than['.$this->input->post('capital_price').']', array('greater_than' => 'The %s must greater than Capital price'));
          if ($this->form_validation->run()==false) {
               $this->data['title'] = 'Ubah data pemesanan';
               $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id', true));
               $this->data['orders'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
               $this->load->view('invoice/purchasing/update-invoice', $this->data);
               $this->load->view('invoice/purchasing/modals', $this->data);
          }else{
               $this->data = [
                    'invoice_code'  => htmlspecialchars($this->input->post('invoice_code', true)),
                    'invoice_name'  => htmlspecialchars($this->input->post('invoice_name', true)),
                    'quantity'      => htmlspecialchars($this->input->post('quantity', true)),
                    'unit'          => htmlspecialchars($this->input->post('unit', true)),
                    'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
                    'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
               ];
               $this->M_invoice->invoice_update($this->data);
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
               redirect('purchase');
          }
     }
     public function info_invoice()
     {
          $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id', true));
          if ($this->data['invoice']) {
               $this->data['orders'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
               $this->data['title'] = 'Detail informasi pembelian';
               $this->load->view('invoice/purchasing/info-invoice', $this->data);
          }else{
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to select data');
               redirect('purchase');
          }
     }

     public function invoice_order_remove()
     {
          $order = $this->db->get_where('tbl_order', array('index_order' => $this->input->post('id_order', true)))->row_array(); //index_order
          $this->db->set('quantity', '`quantity`'+((int)$order['quantity']<=0)?abs((int)$order['quantity']):(-1*(int)$order['quantity']));
          $this->db->where('item_code', $order['item_id']);
          if($this->db->update('tbl_item')){
               $this->db->where('index_order', $this->input->post('id_order', true));
               $this->db->delete('tbl_order');
               Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
               redirect($_SERVER['HTTP_REFERER']);
          }else{
               Flasher::setFlash('info', 'error', 'Failed', ' something worng to select data');
               redirect($_SERVER['HTTP_REFERER']);
          }

     }
}