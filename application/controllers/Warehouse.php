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
        $this->load->model('M_history');
        $this->data['user'] = $this->M_users->user_select(
            $this->session->userdata('email')
        );
    } 
    public function index()
    {
        $this->data['title']    = 'Buat antrian pesanan barang';
        $this->data['plugins']  = [
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
        ];
        $this->load->view('warehouse/index', $this->data);

    }
    public function info()
    {
        $this->data['title']          = 'Riwayat pesanan barang';
        $id_invoice                   = $this->input->get('id');
        $this->data['invoice']        = $this->M_invoice->invoice_select($id_invoice);
        $this->data['orders']         = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
        $this->data['invoice_return'] = $this->M_invoice->invoice_select_by_reference($id_invoice);
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
        $this->data['title']    = 'Buat antrian pesanan barang';
        // $this->data['invoices'] = $this->M_invoice->invoice_select(
        //     false,'/INV/WHS/'
        // );
        
        $this->data['invoices']  = $this->M_warehouse->warehouse_select(
            false,'/INV/WHS/'
        );
        $this->data['returns']  = $this->M_warehouse->warehouse_select(
            false,'/INV/RET/'
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
            $this->_check_quantity($this->input->post('item_code'),$this->input->post('quantity'));
            $this->add_invoice();
            Flasher::setFlash('info','success','Success',' data berhasil di tambahkan');
            redirect('warehouse/queue');
        }
    }

    protected function add_invoice()
    {
        // CHECK AT HERE... // BUAT TERPISAH DI MODEL.. BUKAN DI CONTROLLERNYA SINI.
        // $this->db->like('order_id', '/ORD/WHS/' . date('my'), 'before');
        // $order_id = sprintf('%04s/ORD/WHS/',$this->db->get('tbl_order')->num_rows() + 1) . date('my');
        $order_id = $this->M_order->create_order_id();
        // $this->db->like('invoice_id', '/INV/WHS/' . date('my'), 'before');
        // $invoice_id = sprintf('%04s/INV/WHS/',$this->db->get('tbl_invoice')->num_rows() + 1) . date('my');
        $invoice_id = $this->M_invoice->create_invoice_id();
        // CHECK AT HERE...

        $this->tmp = [];
        $this->total_item = 0;
        foreach ($this->input->post('item_code', true) as $key => $value) {
            $this->request['order']['order_id'][$key]           = $order_id;
            $this->request['order']['item_code'][$key]          = $this->input->post('item_code',true)[$key];
            $this->request['order']['item_capital_price'][$key] = $this->input->post('item_capital_price', true)[$key];
            $this->request['order']['item_selling_price'][$key] = $this->input->post('item_selling_price', true)[$key];
            $this->request['order']['item_quantity'][$key]      = -(int) $this->input->post('quantity', true)[$key];
            $this->request['order']['item_unit'][$key]          = $this->input->post('unit',true)[$key];
            $this->request['order']['rebate_price'][$key]       = $this->input->post('rebate_price', true)[$key];
            $this->request['order']['created_by'][$key]         = $this->data['user']['user_fullname'];
            $this->request['order']['user_id'][$key]            = $this->input->post('user_id', true);
            $this->total_item += (int) $this->input->post('quantity', true)[$key];
            $this->request['order']['status_in_out'][$key]      = 'OUT ('.(int) $this->input->post('quantity', true)[$key].'), <a href="'.base_url('warehouse/info?id=').$invoice_id.'">'.$invoice_id.
            '</a>, Sisa: '.((int)$this->input->post('current', true)[$key]-(int)$this->input->post('quantity', true)[$key]).' '.$this->input->post('unit',true)[$key];
        }
        $this->invoice = [
            'invoice_id'              => $invoice_id,
            'to_customer_destination' => $this->input->post('user_id', true),
            'order_id'                => $order_id,
            'sub_total'               => $this->input->post('sub_total', true) ? $this->input->post('sub_total', true) : 0,
            'discount'                => $this->input->post('discount', true) ? $this->input->post('discount', true) : 0,
            'shipping_cost'           => $this->input->post('shipping_cost', true) ? $this->input->post('shipping_cost', true) : 0,
            'other_cost'              => $this->input->post('other_cost', true) ? $this->input->post('other_cost', true) : 0,
            'grand_total'             => $this->input->post('grand_total', true) ? $this->input->post('grand_total', true) : 0,
            'status_active'           => 1,
            'status_item'             => 0,
            'status_validation'       => 0,
            'status_payment'          => $this->input->post('status_payment', true) ? 1 : 0,
            'status_settlement'       => $this->input->post('status_payment', true) ? 1 : 0,
            'user'                    => $this->session->userdata('fullname'),
            'note'                    => $this->input->post('note', true) ? 
                'Jumlah item: ('.$this->total_item.'), '.$this->input->post('note', true).' '.$this->data['user']['user_fullname'] : 
                'Jumlah item: ('.$this->total_item.'), '.'Di input oleh bagian gudang :'.$this->data['user']['user_fullname'].',<br> ' . implode(', ', $this->request['order']['item_code']),
            'created_by'              => $this->data['user']['user_fullname'],

        ];
        try {
            $this->M_invoice->invoice_insert($this->invoice);
            $this->M_order->order_insert_history_update_item($this->request['order']);             
            return true;
        } catch (Exception $e) {
            return $e;
        }

    }

    public function edit() // OK
    {
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
            'module' => [
                base_url('assets/pages/warehouse/edit-queue.js')
            ],
        ];

        $this->form_validation->set_rules('order_id','Curent Order','required|trim');
        if ($this->form_validation->run() == false) {
            $this->data['title'] = 'Update Order';
            $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id'), false);
            $this->data['orders'] = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
            $this->load->view('warehouse/queue/update-queue', $this->data);
        }else{
            $this->total_item = 0;
            foreach ($this->input->post('item_code', true) as $key => $value) {

                $tmp[$key] = array(
                    'item_code'          => $this->input->post('item_code',true)[$key],
                    'quantity'           => (int) $this->input->post('current',true)[$key]
                );

                $this->total_item += (int) $this->input->post('quantity', true)[$key];
                $index_order = @$this->input->post('index_order', true)[$key];
                $order[$key] = array(
                    'index_order'        => ($index_order)?$index_order:false,
                    'item_id'            => $this->input->post('item_code',true)[$key],
                    'order_id'           => $this->input->post('order_id', true),
                    'quantity'           => -(int) $this->input->post('quantity', true)[$key],
                    'unit'               => $this->input->post('unit',true)[$key],
                    'updated_by'         => $this->data['user']['user_fullname'],
                    'updated_at'         => date('Y-m-d H:i:s',time()),
                );
                $history[$key] = array(
                    'previous_quantity'  => (int) $this->input->post('current',true)[$key],
                    'item_code'          => $this->input->post('item_code',true)[$key],
                    'status_in_out'      => 'OUT ('.(int) $this->input->post('quantity', true)[$key].') <a href="'.base_url('warehouse/info?id=').$this->input->get('id').'">'.$this->input->get('id').'</a> UPDATE, Sisa: '.abs((int) $this->input->post('current',true)[$key]-(int) $this->input->post('quantity', true)[$key]).' '.$this->input->post('unit',true)[$key],
                    'created_by'         => $this->data['user']['user_fullname'],
                    'updated_by'         => $this->data['user']['user_fullname'],
                    'updated_at'         => date('Y-m-d H:i:s',time()),
                );
                $item[$key] = array(
                    'item_code'          => $this->input->post('item_code',true)[$key],
                    'quantity'           => (int) $this->input->post('current',true)[$key]-(int) $this->input->post('quantity', true)[$key]
                );
                $quantity[$key] = array(
                    'item_code'          => $this->input->post('item_code', true)[$key],
                    'quantity'           => $this->input->post('quantity', true)[$key],
                    'current'            => $this->input->post('current', true)[$key],
                    'total_'             => $this->input->post('current', true)[$key]-$this->input->post('quantity', true)[$key], 
                );
            }

            $invoice = [
                'invoice_id'             => $this->input->get('id'),
                'note'                   => $this->input->post('note', true) ? 
                    'Jumlah item: ('.$this->total_item.'), '.$this->input->post('note', true).' '.$this->data['user']['user_fullname'] : 
                    'Jumlah item: ('.$this->total_item.'), '.'Di input, dan diubah oleh bagian gudang :'.$this->data['user']['user_fullname']
            ];
            try {
                $this->M_items->item_update_multiple($tmp);
            } catch (Exception $e) {
                Flasher::setFlash('info','error','Failed ',$e);
                redirect('warehouse/update?id='.$this->data['invoice']['invoice_id']);
            }
            $this->_check_quantity($this->input->post('item_code'),$this->input->post('quantity'));
            try {
                $this->M_items->item_update_multiple($item);
                $this->M_order->order_update_multiple($order);
                $this->M_history->history_insert_multiple($history);
                $this->M_invoice->warehouse_invoice_update($invoice);
                
                Flasher::setFlash('info','success','Success',' data berhasil di tambahkan');
                redirect('warehouse/queue');
            } catch (Exception $e) {
                Flasher::setFlash('info','error','Failed ',$e);
                redirect('warehouse/update?id='.$this->data['invoice']['invoice_id']);
            }
        }
    }

    private function _check_quantity($id, $quantity)
    {
        foreach ($id as $key => $value) {
            $tmp_value         = $value;
            $tmp[$tmp_value][] = $quantity[$key];
        }
        foreach ($tmp as $key => $value) {
            $result[] = [
                'item_code'     => $key,
                'item_quantity' => array_sum($value),
            ];
        }
        foreach ($result as $key => $value) {
            $item = $this->M_items->item_select($value['item_code']);
            if ((int) $item['quantity'] - (int) $value['item_quantity'] < 0) {
                Flasher::setFlash('info','error','Failed',' <b> data gagal ditambahkan</b> ');
                redirect('stocks');
                return false;
                die();
            } else {
                return true;
            }
            var_dump((int) $item['quantity'] - (int) $value['item_quantity'] <= 0);
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
                        'item_code'     => '',
                        'item_name'     => '',
                        'quantity'      => '',
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
                $this->data = $this->M_items->item_select_by_code($this->input->post('data'), 15);
                $this->_result_list_item($this->data);
            } elseif ($this->input->post('_data')) {
                $this->data = $this->M_items->item_select_like_name($this->input->post('_data'), 15);
                $this->_result_list_item($this->data);
            } else {
                $this->db->limit(5);
                $this->db->where('is_active', 1);
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
    public function cancel() // OK
    {
        $this->data['invoice'] = $this->M_invoice->invoice_select($this->input->post('invoice_id'));
        $this->data['order']   = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
        foreach ($this->data['order'] as $key => $value) {
            $this->db->select('item_code, quantity');
            $this->db->where('item_code', $value['item_code']);
            //create history item
            $this->data['history'][$key]                      = $this->db->get('tbl_item')->row_array();
            $this->data['history'][$key]['status_in_out']     = 'IN ('.abs($this->data['order'][$key]['quantity_order']).') <a href="'.base_url('warehouse/info?id=').$this->input->post('invoice_id', true).'">'.$this->input->post('invoice_id', true).'</a>, CANCEL, Sisa: '.(abs($this->data['order'][$key]['quantity_order'])+(int)$this->data['history'][$key]['quantity']);
            $this->data['history'][$key]['previous_quantity'] = $this->data['history'][$key]['quantity'];
            $this->data['history'][$key]['updated_at']        = date('Y-m-d H:i:s',time());
            $this->data['item'][$key]['item_code']            = $this->data['order'][$key]['item_code'];
            $this->data['item'][$key]['quantity']             = abs($this->data['order'][$key]['quantity_order']);
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
    public function update_status_return()// OK
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
            $this->db->set('status_in_out', ((int)$data_order[$key]['quantity_order']<0)?
                'OUT'. ' (' . abs($data_order[$key]['quantity_order']) . ') <a href="'.base_url('warehouse/info?id=').$this->input->post('invoice_reverence').'">'.$this->input->post('invoice_reverence').'</a> -> <a href="'.base_url('warehouse/info?id=').$data_invoice['invoice_id'].'">'.$data_invoice['invoice_id'].'</a> RETURN, Sisa: '.
                ((int)$history[$key]['quantity'] + $data_order[$key]['quantity_order']):
                'IN' . ' (' . abs($data_order[$key]['quantity_order']) . ') <a href="'.base_url('warehouse/info?id=').$this->input->post('invoice_reverence').'">'.$this->input->post('invoice_reverence').'</a> -> <a href="'.base_url('warehouse/info?id=').$data_invoice['invoice_id'].'">'.$data_invoice['invoice_id'].'</a> RETURN, Sisa: '.
                ((int)$history[$key]['quantity'] + $data_order[$key]['quantity_order'])
            );
            $this->db->set('updated_at', date('Y-m-d H:i:s',time()));
            $this->db->set('updated_by', $this->data['user']['user_fullname']);
            $this->db->set('created_by', $this->data['user']['user_fullname']);
            $this->db->insert('tbl_item_history');
            // update quantity item

            // ketika barang sama di input lebih dari 2x dan di kembalikan. data yang terbaca hanya 1.
            $this->M_items->item_update_quantity($order['item_code'],(int) $order['quantity_order']);
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
    public function order_item_remove()// OK
    {
        // code...
        $this->db->where('index_order', $this->input->post('index_order', true));
        $this->db->where('order_id', $this->input->post('order_id', true));
        $data['order'] = $this->db->get('tbl_order')->row_array();
        $data['invoice'] = $this->db->get_where('tbl_invoice', array('order_id' => $this->input->post('order_id', true)))->row_array();
        
        $this->db->where('item_code', $data['order']['item_id']);
        $data['item'] = $this->db->get('tbl_item')->row_array();

        $data['item']['quantity'] = $data['item']['quantity']+abs($data['order']['quantity']);
        $data['item']['update_by'] = $this->data['user']['user_fullname'];
        $data['history'] = array(
            0 => array(
                'item_code' => $data['order']['item_id'],
                'previous_selling_price' => 0,
                'previous_capital_price' => 0,
                'previous_quantity' => $data['item']['quantity']+$data['order']['quantity'],
                'created_by' => $this->data['user']['user_fullname'],
                'created_at' => date('Y-m-d H:i:s',time()),
                'created_by' => $this->data['user']['user_fullname'],
                'updated_at' => date('Y-m-d H:i:s',time()),
                'status_in_out' => 'IN ('.abs($data['order']['quantity']).'), <a href="'.base_url('warehouse/info?id=').$data['invoice']['invoice_id'].'">'.$data['invoice']['invoice_id'].'</a>, Sisa: '.
                                    ((int)$data['item']['quantity']).' '.$data['order']['unit'],
            ),
        );

        try {
            $this->M_items->item_update($data['item']);
            $this->M_history->history_insert_multiple($data['history']);
            $this->M_order->order_delete($data['order']);
            
            Flasher::setFlash('info','success','Success',' data berhasil di tambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        } catch (Exception $e) {
            Flasher::setFlash('info','error','Failed ',$e);
            redirect('warehouse/queue');
        }
    }
    public function notification()
    {
        $this->db->where('status_notification', 1);
        $this->db->like('invoice_id', '/INV/RET/' . date('my'), 'before');
        echo json_encode($this->db->get('tbl_invoice')->result_array());
    }

    public function serverside_datatables_data_warehouse()
    {


        $response = array();

        $postData = $this->input->post();

        ## Read value
        $draw            = $postData['draw'];
        $start           = $postData['start'];
        $rowperpage      = $postData['length']; // Rows display per page
        $columnIndex     = $postData['order'][0]['column']; // Column index
        $columnName      = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue     = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (item_name like '%".$searchValue."%' or item_code like '%".$searchValue."%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->like('invoice.invoice_id', 'INV/WHS/', 'both');
        $records = $this->db->get('tbl_invoice invoice')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->like('invoice.invoice_id', $searchValue, 'both');
            $this->db->or_like('invoice.to_customer_destination', $searchValue, 'both');
            $this->db->or_like('invoice.note', $searchValue, 'both');
            $this->db->or_like('user_info.user_fullname', $searchValue, 'both');
            $this->db->or_like('user_info.user_address', $searchValue, 'both');
            $this->db->or_like('user_info.village', $searchValue, 'both');
            $this->db->or_like('user_info.sub-district', $searchValue, 'both');
            $this->db->or_like('user_info.district', $searchValue, 'both');
        }
        $this->db->like('invoice.invoice_id', 'INV/WHS/', 'both');
        $this->db->join('tbl_user_information user_info', 'invoice.to_customer_destination = user_info.user_id', 'left');
        // $this->db->like('invoice.date', date('Y-m-d'), 'after'); // filter with date current
        $this->db->order_by('invoice.date', 'DESC');

        $records = $this->db->get('tbl_invoice invoice')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*, invoice.note as note_invoice, invoice.order_id as invoice_order_id');
        if($searchQuery != ''){
            $this->db->like('invoice.invoice_id', $searchValue, 'both');
            $this->db->or_like('invoice.to_customer_destination', $searchValue, 'both');
            $this->db->or_like('invoice.note', $searchValue, 'both');
            $this->db->or_like('user_info.user_fullname', $searchValue, 'both');
            $this->db->or_like('user_info.user_address', $searchValue, 'both');
            $this->db->or_like('user_info.village', $searchValue, 'both');
            $this->db->or_like('user_info.sub-district', $searchValue, 'both');
            $this->db->or_like('user_info.district', $searchValue, 'both');
        }
        $this->db->like('invoice.invoice_id', 'INV/WHS/', 'both');
        $this->db->join('tbl_user_information user_info', 'invoice.to_customer_destination = user_info.user_id', 'left');
        // $this->db->like('invoice.date', date('Y-m-d'), 'after'); // filter with date current
        $this->db->order_by('invoice.date', 'DESC');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('tbl_invoice invoice')->result();

        $data = array();

        foreach($records as $record ){

            $data[] = array( 
                "invoice_id"    =>$record->invoice_id,
                "note_invoice"  =>$record->note,
                "user_fullname" =>$record->user_fullname,
                "user_address"  =>$record->user_address,
            ); 
        }

        ## Response
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData"               => $records
        );
        $this->output->set_content_type('application/json')->set_output(json_encode( $response ));
    }
}