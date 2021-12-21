<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipping extends CI_Controller
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
        $this->load->model('M_shipping');
        $this->load->model('M_order');
        $this->load->model('M_users');
        $this->data['user'] = $this->M_users->user_select(
            $this->session->userdata('email')
        );
    }
    public function index()
    {
        $this->data['title'] = 'Daftar antrian pesanan barang dari gudang';
        $this->data['invoices'] = $this->M_shipping->shipping_select(
            false,
            'INV/SEL/'
        );
        $this->data['returns'] = $this->M_invoice->invoice_select(
            false,
            'INV/RET/'
        );
        $this->data['plugins'] = [
            'css' => [
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.structure.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.theme.min.css'
                ),
            ],
            'js' => [
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js'
                ),
            ],
            'module' => [base_url('assets/pages/shipping/index.js')],
        ];
        $this->form_validation->set_rules(
            'user_id',
            'Customer',
            'required|trim'
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('shipping/queue/index', $this->data);
            $this->load->view('shipping/queue/modals');
        } else {
            $this->add_invoice();
        }
    }

    protected function add_invoice()
    {
        $this->db->group_by('order_id');
        $order_id =
            sprintf(
                '%04s/ORD/RET/',
                $this->db->get('tbl_order')->num_rows() + 1
            ) . date('my');
        $this->db->like('invoice_id', '/INV/RET/' . date('my'), 'before');
        $invoice_id =
            sprintf(
                '%04s/INV/RET/',
                $this->db->get('tbl_invoice')->num_rows() + 1
            ) . date('my');

        foreach ($this->input->post('item_code', true) as $key => $value) {
            $this->request['order']['order_id'][$key] = $order_id;
            $this->request['order']['item_code'][$key] = $this->input->post(
                'item_code',
                true
            )[$key];
            $this->request['order']['item_capital_price'][
                $key
            ] = $this->input->post('item_capital_price', true)[$key]
                ? $this->input->post('item_capital_price', true)[$key]
                : 0;
            $this->request['order']['item_selling_price'][
                $key
            ] = $this->input->post('item_selling_price', true)[$key]
                ? $this->input->post('item_selling_price', true)[$key]
                : 0;
            $this->request['order']['item_quantity'][$key] = $this->input->post(
                'quantity',
                true
            )[$key];
            $this->request['order']['item_unit'][$key] = $this->input->post(
                'unit',
                true
            )[$key];
            $this->request['order']['rebate_price'][$key] = $this->input->post(
                'rebate_price',
                true
            )[$key]
                ? $this->input->post('rebate_price', true)[$key]
                : 0;
            $this->request['order']['status_in_out'][$key] =
                $this->input->post('quantity', true)[$key] > 0 ? 'IN' : 'OUT';
            $this->request['order']['user_id'][$key] = $this->input->post(
                'user_id',
                true
            );
            $this->request['order']['date'][$key] = time();
        }

        $this->invoice = [
            'invoice_id' => $invoice_id,
            'invoice_reverence' => $this->input->post(
                'invoice_reverence_id',
                true
            ),
            'date' => time(),
            'date_due' => time() + 7 * 24 * 60 * 60, //7 days; 24 hours; 60 mins; 60 secs
            'to_customer_destination' => $this->input->post('user_id', true),
            'order_id' => $order_id,
            'sub_total' => $this->input->post('sub_total', true)
                ? $this->input->post('sub_total', true)
                : 0,
            'discount' => $this->input->post('discount', true)
                ? $this->input->post('discount', true)
                : 0,
            'shipping_cost' => $this->input->post('shipping_cost', true)
                ? $this->input->post('shipping_cost', true)
                : 0,
            'other_cost' => $this->input->post('other_cost', true)
                ? $this->input->post('other_cost', true)
                : 0,
            'grand_total' => $this->input->post('grand_total', true)
                ? $this->input->post('grand_total', true)
                : 0,
            'status_active' => 1,
            'status_item' => 0,
            'status_validation' => 0,
            'status_payment' => $this->input->post('status_payment', true)
                ? 1
                : 0,
            'status_settlement' => $this->input->post('status_payment', true)
                ? 1
                : 0,
            'user' => $this->session->userdata('fullname'),
            'note' => $this->input->post('note', true)
                ? $this->input->post('note', true)
                : 'Di input oleh bagian pengiriman: ' .
                    implode(', ', $this->request['order']['item_code']),
        ];
        // insert to tbl_order
        $this->M_order->order_insert($this->request['order']);
        $this->M_invoice->invoice_insert($this->invoice);
        Flasher::setFlash(
            'info',
            'success',
            'Success',
            ' Berhasil tambah data!'
        );
        redirect('shipping/queue');
    }

    public function return()
    {
        if (!$this->input->get('id')) {
            Flasher::setFlash(
                'info',
                'error',
                'Error,',
                ' informasi tidak sesuai, coba lagi!'
            );
            redirect('shipping/queue');
            die();
        }
        $this->data['title'] = 'Buat pengembalian barang ke gudang';
        $this->data['invoice'] = $this->M_shipping->shipping_select(
            $this->input->get('id')
        );
        $this->data['orders'] = $this->M_order->order_select(
            $this->data['invoice']['invoice_order_id']
        );
        $this->data['plugins'] = [
            'css' => [
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.structure.min.css'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.theme.min.css'
                ),
            ],
            'js' => [
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'
                ),
                base_url(
                    'assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js'
                ),
            ],
            'module' => [base_url('assets/pages/shipping/return.js')],
        ];
        $this->form_validation->set_rules(
            'user_id',
            'Customer',
            'required|trim'
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('shipping/queue/return', $this->data);
        } else {
            $this->add_invoice();
        }
    }

    public function get_item_invoice()
    {
        if ($this->input->post('request')) {
            if ($this->input->post('data')) {
                $this->data = $this->db
                    ->get_where('tbl_item', [
                        'item_code' => $this->input->post('data'),
                    ])
                    ->row_array();
                if ($this->data) {
                    echo json_encode($this->data);
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
            } elseif ($this->input->post('_data')) {
                $this->db->like(
                    'item_name',
                    $this->input->post('_data'),
                    'both'
                );
                $this->data = $this->db->get('tbl_item')->result_array();
                if ($this->data) {
                    echo json_encode($this->data);
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
            } else {
                echo json_encode($this->db->get('tbl_item')->result_array());
            }
        }
    }

    public function update_status()
    {
        $this->form_validation->set_rules(
            'invoice_id',
            'Code invoice',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'invoice_status',
            'Status invoice',
            'required|trim'
        );
        if ($this->form_validation->run() == false) {
            Flasher::setFlash(
                'info',
                'error',
                'Failed',
                ' Gagal update data! ' . validation_errors()
            );
            redirect('shipping/queue');
        } else {
            if ($this->input->post('invoice_status') == 'status_validation') {
                //status item 1
                $this->request['status_validation'] = $this->_status_check(1);
                $this->db->where(
                    'invoice_id',
                    $this->input->post('invoice_id', true)
                );
                $this->db->update('tbl_invoice', $this->request);
            } else {
                // status validation 3
                $this->request['status_item'] = $this->_status_check(3);
                $this->db->where(
                    'invoice_id',
                    $this->input->post('invoice_id', true)
                );
                $this->db->update('tbl_invoice', $this->request);
            }
            $this->db->where(
                'invoice_id',
                $this->input->post('invoice_id', true)
            );
            $this->db->set('status_notification', 0);
            $this->db->update('tbl_invoice');
            Flasher::setFlash(
                'info',
                'success',
                'Success',
                ' Berhasil ubah data!'
            );
            redirect('shipping/queue');
        }
    }

    public function notification_change()
    {
        // change status invoice
        $this->db->set('status_item', 3);
        $this->db->where('order_id', $this->input->post('order_id', true));
        $this->db->update('tbl_invoice');

        $this->db->where('order_id', $this->input->post('order_id', true));
        $this->db->set('status_notification', 0);
        $this->db->update('tbl_invoice');
    }

    private function _status_check($limit)
    {
        // check status infoice, user in update status..
        if (
            $this->db
                ->get_where('tbl_invoice', [
                    'invoice_id' => $this->input->post('invoice_id'),
                ])
                ->row_array()[$this->input->post('invoice_status')] == $limit
        ) {
            return 0;
        } else {
            return $limit +
                $this->db
                    ->get_where('tbl_invoice', [
                        'invoice_id' => $this->input->post('invoice_id'),
                    ])
                    ->row_array()[$this->input->post('invoice_status')];
        }
    }

    public function cancel()
    {
        $this->db->set(
            'status_active',
            $this->input->post('invoice_status', true)
        );
        $this->db->where('invoice_id', $this->input->post('invoice_id', true));
        $this->db->update('tbl_invoice');

        Flasher::setFlash('info', 'success', 'Success', ' Berhasil ubah data!');
        redirect('shipping/queue');
    }

    public function list_item()
    {
        if ($this->input->post('request')) {
            if ($this->input->post('data')) {
                $this->data = $this->db
                    ->get_where('tbl_item', [
                        'item_code' => $this->input->post('data'),
                    ])
                    ->row_array();
                if ($this->data) {
                    echo json_encode($this->data);
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
            } elseif ($this->input->post('_data')) {
                $this->db->like(
                    'item_name',
                    $this->input->post('_data'),
                    'both'
                );
                $this->data = $this->db->get('tbl_item')->result_array();
                if ($this->data) {
                    echo json_encode($this->data);
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
            } else {
                echo json_encode($this->db->get('tbl_item')->result_array());
            }
        }
    }

    public function notification()
    {
        $this->db->where('status_notification', 1);
        // $this->db->like('invoice_id', 'INV/SEL/', 'both');
        $this->db->like('invoice_id', '/INV/SEL/' . date('my'), 'before');
        echo json_encode($this->db->get('tbl_invoice')->result_array());
    }
}
