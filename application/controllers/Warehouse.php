<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_signin(get_class($this));
        $this->load->model('M_invoice');
        $this->load->model('M_warehouse');
        $this->load->model('M_order');
        $this->load->model('M_items');
        $this->load->model('M_users');
        $this->load->model('M_stock');
        $this->data['user'] = $this->M_users->user_select(
            $this->session->userdata('email')
        );
    }
    public function index()
    {
        $this->data['title'] = 'Buat antrian pesanan barang';
        $this->data['invoices'] = $this->M_invoice->invoice_history_select(false,'INV/SEL/');
        $this->data['plugins'] = [
            'css' => [
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
            ],
            'js' => [
                base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
            ],
            'module' => [base_url('assets/pages/warehouse/index.js')],
        ];
        $this->form_validation->set_rules('user_id','Customer','required|trim');
        $this->form_validation->set_rules('item_name[]','Barang','required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('warehouse/index', $this->data);
        } else {
            $this->add_invoice();
        }
    }
    public function info()
    {
        $this->data['title']   = 'Riwayat pesanan barang';
        $id_invoice = $this->input->get('id');
        $this->data['invoice'] = $this->M_invoice->invoice_select($id_invoice);
        $this->data['orders']  = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
        $this->data['invoice_return']  = $this->M_invoice->invoice_select_by_reference($id_invoice);
        if ($this->data['invoice_return']) {
            $this->data['order_return']  = $this->M_order->order_select($this->data['invoice_return']['invoice_order_id']);
        }

        
        $this->data['plugins'] = ['css' => [
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
            ],
            'js' => [
                base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
            ],
            'module' => [base_url('assets/pages/warehouse/index.js')],
        ];

        if($this->data['orders']){
            $this->load->view('warehouse/info', $this->data);
        }else{
            Flasher::setFlash('info','error','Failed',' kesalahan informasi!');
            redirect('warehouse');    
        }
    }
    public function queue()
    {
        $this->data['title'] = 'Buat antrian pesanan barang';
        $this->data['invoices'] = $this->M_invoice->invoice_select(
            false,'INV/SEL/'
        );
        $this->data['returns'] = $this->M_warehouse->warehouse_select(
            false,'INV/RET/'
        );
        $this->data['plugins'] = ['css' => [
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
            'module' => [base_url('assets/pages/warehouse/queue.js')],
        ];
        $this->form_validation->set_rules('user_id','Customer','required|trim');
        $this->form_validation->set_rules('item_name[]','Barang','required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('warehouse/queue/queue', $this->data);
            $this->load->view('warehouse/queue/modals');
        } else {
            $this->add_invoice();
        }
    }

    protected function add_invoice()
    {
        $this->db->like('order_id', '/ORD/SEL/' . date('my'), 'before');
        $order_id = sprintf('%04s/ORD/SEL/',$this->db->get('tbl_order')->num_rows() + 1) . date('my');

        $this->db->like('invoice_id', '/INV/SEL/' . date('my'), 'before');
        $invoice_id = sprintf('%04s/INV/SEL/',$this->db->get('tbl_invoice')->num_rows() + 1) . date('my');

        $this->tmp = [];
        foreach ($this->input->post('item_code', true) as $key => $value) {
            $this->request['order']['order_id'][$key] = $order_id;
            $this->request['order']['item_code'][$key] = $this->input->post('item_code',true)[$key];
            $this->request['order']['item_capital_price'][$key] = $this->input->post('item_capital_price', true)[$key];
            $this->request['order']['item_selling_price'][$key] = $this->input->post('item_selling_price', true)[$key];
            $this->request['order']['item_quantity'][$key] = -(int) $this->input->post('quantity', true)[$key];
            $this->request['order']['item_unit'][$key] = $this->input->post('unit',true)[$key];
            $this->request['order']['rebate_price'][$key] = $this->input->post('rebate_price', true)[$key];
            $this->request['order']['status_in_out'][$key] = 'OUT';
            $this->request['order']['user_id'][$key] = $this->input->post('user_id', true);
            $this->request['order']['date'][$key] = date('d F Y - H:i:s',time());
            $this->_check_quantity($this->input->post('item_code'),$this->input->post('quantity'));
        }

        $this->invoice = [
            'invoice_id' => $invoice_id,
            'date' => date('d F Y - H:i:s',time()),
            'date_due' => date('d F Y - H:i:s',time() + 7 * 24 * 60 * 60), //7 days; 24 hours; 60 mins; 60 secs
            'to_customer_destination' => $this->input->post('user_id', true),
            'order_id' => $order_id,
            'sub_total' => $this->input->post('sub_total', true) ? $this->input->post('sub_total', true) : 0,
            'discount' => $this->input->post('discount', true) ? $this->input->post('discount', true) : 0,
            'shipping_cost' => $this->input->post('shipping_cost', true) ? $this->input->post('shipping_cost', true) : 0,
            'other_cost' => $this->input->post('other_cost', true) ? $this->input->post('other_cost', true) : 0,
            'grand_total' => $this->input->post('grand_total', true) ? $this->input->post('grand_total', true) : 0,
            'status_active' => 1,
            'status_item' => 0,
            'status_validation' => 0,
            'status_payment' => $this->input->post('status_payment', true) ? 1 : 0,
            'status_settlement' => $this->input->post('status_payment', true) ? 1 : 0,
            'user' => $this->session->userdata('fullname'),
            'note' => $this->input->post('note', true) ? $this->input->post('note', true) : 'Di input oleh bagian gudang ' . implode(', ', $this->request['order']['item_code']),
        ];
        try {
            $this->M_invoice->invoice_insert($this->invoice);
            $this->M_order->order_insert_history_update_item($this->request['order']); // insert to tbl_order, insert to tbl_history, and update item
            Flasher::setFlash('info','success','Success',' data berhasil di tambahkan');
            redirect('warehouse/queue');
        } catch (Exception $e) {
            Flasher::setFlash('info','error','Failed ',$e);
            redirect('warehouse/queue');
        }

    }

    private function _check_quantity($id, $quantity)
    {
        foreach ($id as $key => $value) {
            $tmp_value = $value;
            $tmp[$tmp_value][] = $quantity[$key];
        }
        foreach ($tmp as $key => $value) {
            $result[] = [
                'item_code' => $key,
                'item_quantity' => array_sum($value),
            ];
        }
        foreach ($result as $key => $value) {
            $item = $this->M_items->item_select($value['item_code']);
            if ((int) $item['quantity'] - (int) $value['item_quantity'] < 0) {
                Flasher::setFlash(
                    'info',
                    'error',
                    'Failed',
                    ' <b>data gagal ditambahkan</b> ' . validation_errors()
                );
                redirect('warehouse/queue');
                return false;
                die();
            } else {
                return true;
            }
            var_dump((int) $item['quantity'] - (int) $value['item_quantity'] < 0);
        }
    }

    private function _result_list_item($data)
    {
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(
                $data = [
                    '0' => [
                        'item_code' => '',
                        'item_name' => '',
                        'quantity' => '',
                        'capital_price' => '',
                        'selling_price' => '',
                    ],
                ]
            );
        }
    }

    public function list_item()
    {
        if ($this->input->post('request')) {
            if ($this->input->post('data')) {
                $this->data = $this->M_items->item_select_by_code($this->input->post('data'), 5);
                $this->_result_list_item($this->data);
            } elseif ($this->input->post('_data')) {
                $this->data = $this->M_items->item_select_like_name($this->input->post('_data'),5);
                $this->_result_list_item($this->data);
            } else {
                $this->db->limit(5);
                echo json_encode($this->db->get('tbl_item')->result_array());
            }
        }
    }

    public function update_status()
    {
        $this->form_validation->set_rules('invoice_id','Code invoice','required|trim');
        $this->form_validation->set_rules('invoice_status','Status invoice','required|trim');
        if ($this->form_validation->run() == false) {
            Flasher::setFlash('info','error','Failed',' <b>data gagal ditambahkan</b> ' . validation_errors());
            redirect('warehouse/queue');
        } else {
            if ($this->input->post('invoice_status') == 'status_validation') {
                //status item 1
                $this->request['status_validation'] = $this->_status_check(1);
                $this->db->where('invoice_id',$this->input->post('invoice_id', true));
                $this->db->update('tbl_invoice', $this->request);
            } else {
                // status validation 3
                $this->request['status_item'] = $this->_status_check(3);
                $this->db->where('invoice_id',$this->input->post('invoice_id', true));
                $this->db->update('tbl_invoice', $this->request);
            }
            Flasher::setFlash('info','success','Success',' data berhasil diubah!');
            redirect('warehouse/queue');
        }
    }

    public function notification_change()
    {
        // change status invoice
        $this->db->set('status_item', 3);
        $this->db->set('status_notification', 0);
        $this->db->where('order_id', $this->input->post('order_id', true));
        $this->db->update('tbl_invoice');
    }
    private function _status_check($limit)
    {
        // check status infoice, user in update status..
        $this->db->where('invoice_id', $this->input->post('invoice_id'));
        $this->data = $this->db->get('tbl_invoice')->row_array();
        $invoice_status = $this->input->post('invoice_status');
        if ($this->data[$invoice_status] == $limit) {
            return 0;
        } else {
            return $limit + $this->data[$invoice_status];
        }
    }
    public function cancel()
    {
        $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->post('invoice_id'));
        $this->data['order'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
        foreach ($this->data['order'] as $key => $value) {
            $this->db->select('item_code, quantity');
            $this->db->where('item_code', $value['item_code']);
            //create history item
            $this->data['history'][$key]                     = $this->db->get('tbl_item')->row_array();
            $this->data['history'][$key]['status_in_out']    = 'IN: '.abs($this->data['order'][$key]['quantity_order']);
            $this->data['history'][$key]['previous_quantity']= $this->data['history'][$key]['quantity'];
            $this->data['history'][$key]['update_at']        = date('d F Y - H:i:s',time());
            $this->data['item'][$key]['item_code']           = $this->data['order'][$key]['item_code'];
            $this->data['item'][$key]['quantity']            = abs($this->data['order'][$key]['quantity_order'])+$this->data['history'][$key]['quantity'];
            unset($this->data['history'][$key]['quantity']);
        }
        $this->M_stock->history_item_insert_multiple($this->data);        
        //notification
        $this->db->where('invoice_id',$this->input->post('invoice_id', true));
        $this->db->set('status_validation', 1);
        $this->db->set('status_active', 0);
        $this->db->set('status_notification', 0);
        $this->db->update('tbl_invoice');

        Flasher::setFlash('info','success','Success',' data berhasil diubah!');
        redirect('warehouse/queue');

    }
    public function update_status_return()
    {
        $data_invoice = $this->M_invoice->invoice_select_by_referece($this->input->post('invoice_reverence'));
        $data_order = $this->M_order->order_select($data_invoice['order_id']);
        $history = [];
        foreach ($data_order as $key => $order) {
            //create history item
            $this->db->select('item_code, capital_price, selling_price, quantity');
            $this->db->where('item_code', $data_order[$key]['item_code']);
            array_push($history, $this->db->get('tbl_item')->row_array()); // tmp

            $this->db->set('item_code', $history[$key]['item_code']);
            $this->db->set('previous_capital_price',$history[$key]['capital_price']);
            $this->db->set('previous_selling_price',$history[$key]['selling_price']);
            $this->db->set('previous_quantity', $history[$key]['quantity']);
            $this->db->set('status_in_out', ((int)$data_order[$key]['quantity_order']<0)?'OUT':'IN' . ' (' . $data_order[$key]['quantity_order'] . ')');
            $this->db->set('update_at', date('d F Y - H:i:s',time()));
            $this->db->insert('tbl_item_history');
            // update quantity item
            $this->M_items->item_update_quantity($order['item_code'],(int) $history[$key]['quantity'] + (int) $order['quantity_order']);
        }
        // change status invoice
        if ($this->db->get_where('tbl_invoice', 
        ['invoice_reverence' => $this->input->post('invoice_reverence')])->row_array()[$this->input->post('invoice_status')] == 1) {
            $this->db->set('status_validation', 0);
            $this->db->where('invoice_reverence',$this->input->post('invoice_reverence', true));
            $this->db->update('tbl_invoice');
        } else {
            $this->db->set('status_validation', 1);
            $this->db->where('invoice_reverence',$this->input->post('invoice_reverence', true));
            $this->db->update('tbl_invoice');
        }
        //notification
        $this->db->where('invoice_reverence',$this->input->post('invoice_reverence', true));
        $this->db->set('status_notification', 0);
        $this->db->update('tbl_invoice');

        Flasher::setFlash('info','success','Success',' data berhasil diubah!');
        redirect('warehouse/queue');
    }
    public function notification()
    {
        $this->db->where('status_notification', 1);
        $this->db->like('invoice_id', '/INV/RET/' . date('my'), 'before');
        echo json_encode($this->db->get('tbl_invoice')->result_array());
    }
}