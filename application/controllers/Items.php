<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Items extends CI_Controller
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
        is_signin(get_class($this));
        $this->load->model('M_menu');
        $this->load->model('M_items');
        $this->load->model('M_users');
        date_default_timezone_set('Asia/Jakarta');
        $this->data['user'] = $this->M_users->user_select(
            $this->session->userdata('email')
        );
    }
    public function index()
    {
        $this->data['plugins'] = [
            'css' => [
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'),
                // base_url('assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css'),
                base_url('assets/AdminLTE-3.0.5/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'),
            ],
            'js' => [
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'),
                //base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/inputmask/min/jquery.inputmask.bundle.min.js'),
            ],
            'module' => [base_url('assets/pages/items/index.js')],
        ];
        $this->data['title']     = 'Manajemen barang';
        // $this->data['items']     = $this->M_items->item_select();
        $this->data['categorys'] = $this->M_menu->menu_category_select();

        $this->form_validation->set_rules('category','Category item','required|trim');
        $this->form_validation->set_rules('item_code','Code item','required|trim');
        $this->form_validation->set_rules('item_name','Item name','required|trim');
        // $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
        // $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
        // $this->form_validation->set_rules( // UNCOMMENT IF USE PRISE
        //     'capital_price',
        //     'Capital price',
        //     'required|trim|callback_integer_check'
        // );
        // $this->form_validation->set_rules(
        //     'selling_price',
        //     'Selling price',
        //     'required|trim|callback_integer_check|callback_greater_than_check[' .
        //         $this->input->post('capital_price') .
        //         ']'
        // );                                  // UNCOMMENT IF USE PRISE
        if ($this->form_validation->run() == false) {
            $this->load->view('items/index', $this->data);
            $this->load->view('items/modals');
        } else {
            $this->data = [
                'item_category' => htmlspecialchars($this->input->post('subcategory', true) ? $this->input->post('subcategory', true ): $this->input->post('category', true)),
                'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
                'item_name'     => htmlspecialchars($this->input->post('item_name', true)),
                'unit'          => htmlspecialchars($this->input->post('unit', true)),
                'quantity'      => 0,
                'MG'            => htmlspecialchars($this->input->post('MG', true) ? $this->input->post('MG', true): ''),
                'ML'            => htmlspecialchars($this->input->post('ML', true) ? $this->input->post('ML', true): ''),
                'VG'            => htmlspecialchars($this->input->post('VG', true) ? $this->input->post('VG', true): ''),
                'PG'            => htmlspecialchars($this->input->post('PG', true) ? $this->input->post('PG', true): ''),
                'falvour'       => htmlspecialchars($this->input->post('flavour', true) ? $this->input->post('flavour', true): ''),
                'customs'       => htmlspecialchars($this->input->post('customs', true) ? $this->input->post('customs', true): ''),
                'brand_1'       => htmlspecialchars($this->input->post('brand_1', true) ? $this->input->post('brand_1', true): ''),
                'brand_2'       => htmlspecialchars($this->input->post('brand_2', true) ? $this->input->post('brand_2', true): ''),
                'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
                'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
                'note'          => htmlspecialchars($this->input->post('note', true)),
                'created_by'    => $this->data['user']['user_fullname'],
            ];
            $this->M_items->item_insert($this->data);
            Flasher::setFlash('info','success','Success',' Berhasil input data!'
            );
            redirect('items');
        }
    }
    public function integer_check($value = false)
    {
        $this->form_validation->set_message(
            'integer_check',
            "The {field} must numeric {$value}"
        );
        if (!$value) {
            Flasher::setFlash('info','error','Failed',' informasi tidak sesuai, Coba lagi ' . validation_errors());
            return false;
        }
        if (is_numeric((int) str_replace([',', '.'], ['', ''], $value))) {
            return true;
        } else {
            return false;
        }
    }
    public function greater_than_check($value, $value2)
    {
        $this->form_validation->set_message(
            'greater_than_check',
            "The {field} field must be higher than {$value2}"
        );
        if (!$value) {
            Flasher::setFlash('info','error','Failed',' Gagal update data ' . validation_errors()
            );
            return false;
            redirect('items');
        }
        if (
            (int) str_replace([',', '.'], ['', ''], $value) >=
            (int) str_replace([',', '.'], ['', ''], $value2)
        ) {
            return true;
        } else {
            return false;
        }
        Flasher::setFlash(
            'info',
            'error',
            'Failed',
            ' Gagal update data! ' . validation_errors()
        );
        redirect('items');
    }

    public function update(){
        $this->form_validation->set_rules('item_code','Code item','required|trim');
        $this->form_validation->set_rules('item_name','Item name','required|trim');
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
        // $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
        // $this->form_validation->set_rules(
        //     'capital_price',
        //     'Capital price',
        //     'required|trim|callback_integer_check'
        // );
        // $this->form_validation->set_rules(
        //     'selling_price',
        //     'Selling price',
        //     'required|trim|callback_integer_check|callback_greater_than_check[' .
        //         $this->input->post('capital_price') .
        //         ']',
        //     ['greater_than' => 'The %s must greater than Capital price']
        // );
        if ($this->form_validation->run() == false) {
            $this->data['title']     = 'Informasi barang';
            $this->data['items']     = $this->M_items->item_select($this->input->get('id'));
            $this->data['categorys'] = $this->M_menu->menu_category_select();
            $this->load->view ('items/information', $this->data);
        } else {
            $this->data = [
                'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
                'item_name'     => htmlspecialchars($this->input->post('item_name', true)),
                // 'quantity'   => htmlspecialchars($this->input->post('quantity', true)),
                'unit'          => htmlspecialchars($this->input->post('unit', true)),
                'MG'            => htmlspecialchars($this->input->post('MG', true)? $this->input->post('MG', true): ''),
                'ML'            => htmlspecialchars($this->input->post('ML', true)? $this->input->post('ML', true): ''),
                'VG'            => htmlspecialchars($this->input->post('VG', true)? $this->input->post('VG', true): ''),
                'PG'            => htmlspecialchars($this->input->post('PG', true)? $this->input->post('PG', true): ''),
                'falvour'       => htmlspecialchars($this->input->post('falvour', true)? $this->input->post('falvour', true): ''),
                'customs'       => htmlspecialchars($this->input->post('customs', true)? $this->input->post('customs', true): ''),
                'brand_1'       => htmlspecialchars($this->input->post('brand_1', true)? $this->input->post('brand_1', true): ''),
                'brand_2'       => htmlspecialchars($this->input->post('brand_2', true)? $this->input->post('brand_2', true): ''),
                'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
                'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
                'note'          => htmlspecialchars($this->input->post('note', true)),
                'update_at'     => date('Y-m-d H:i:s',time()),
                'update_by'     => $this->data['user']['user_fullname'],

            ];
            $this->M_items->item_update($this->data);
            Flasher::setFlash('info','success','Success',' berhasil update data!');
            redirect('items');
        }
    }
    public function history()
    {
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
                base_url('assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/inputmask/min/jquery.inputmask.bundle.min.js'),
            ],
            'module' => [base_url('assets/pages/items/index.js')],
        ];
        $this->db->where('item_code', $this->input->get('id'));
        $this->db->order_by('update_at', 'DESC');
        $this->db->order_by('created_at', 'DESC');
        $this->data['history'] = $this->db->get('tbl_item_history')->result_array();
        $this->data['title']= 'Informasi histori barang';
        $this->load->view ('items/history', $this->data);
    }


    public function get_code()
    {
        echo json_encode($this->db->get_where('tbl_item', ['item_category' => $this->input->post('data')])->num_rows());
    }

    public function get_item_invoice()
    {
        if ($this->input->post('request')) {
            if ($this->input->post('data')) {
                $this->data = $this->db->get_where('tbl_item', ['item_code' => $this->input->post('data')])->row_array();
                if ($this->data) {
                    echo json_encode($this->data);
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
                                'item_code'     => '',
                                'item_name'     => '',
                                'quantity'      => '',
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

    public function delete()
    {
        $this->form_validation->set_rules('item_code','Code item','required|trim');
        if ($this->form_validation->run() == false) {
            Flasher::setFlash('info','error','Failed',' Gagal hapus data! ' . validation_errors());
            redirect('items');
        } else {
            $this->data = [
                'item_code' => htmlspecialchars(
                    $this->input->post('item_code', true)
                ),
            ];
            $this->M_items->item_delete($this->data);
            Flasher::setFlash('info','success','Success',' berhasil hapus data!');
            redirect('items');
        }
    }

    // file upload functionality
    public function import()
    {
        $data = [];
        $this->form_validation->set_rules(
            'file',
            'Upload File',
            'callback_checkFileValidation'
        );
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            // If file uploaded
            if (!empty($_FILES['file']['name'])) {
                // get file extension
                $extension = pathinfo(
                    $_FILES['file']['name'],
                    PATHINFO_EXTENSION
                );

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv(); //not problem
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                $spreadsheet    = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet
                    ->getActiveSheet()
                    ->toArray(null, true, true, true);

                // array Count
                if ($this->M_items->item_insert_multiple($allDataInSheet) > 0) {
                    Flasher::setFlash('info','success',',Success !',',Berhasil import data!');
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    Flasher::setFlash('info','warning',',Error !',', informasi yang diterima tidak sesuai, coba lagi' .
                        validation_errors()
                    );
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
        }
    }
    // checkFileValidation
    public function checkFileValidation($string)
    {
        $file_mimes = [
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        if (isset($_FILES['file']['name'])) {
            $arr_file  = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            if (
                ($extension == 'xlsx' ||
                    $extension == 'xls' ||
                    $extension == 'csv') &&
                in_array($_FILES['file']['type'], $file_mimes)
            ) {
                return true;
            } else {
                $this->form_validation->set_message('checkFileValidation','Please choose correct file.');
                Flasher::setFlash('info','error','Failed',' Gagal update data! ' . validation_errors());
                redirect('items');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkFileValidation','Please choose a file.');
            Flasher::setFlash('info','error','Failed',' Gagal update data! ' . 
                validation_errors()
            );
            redirect('items');
            return false;
        }
    }

    public function serverside_datatables_data_items()
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
        $records = $this->db->get('tbl_item')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('tbl_item')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('tbl_item')->result();

        $data = array();

        foreach($records as $record ){

            $data[] = array( 
                "item_code"     =>$record->item_code,
                "item_name"     =>$record->item_name,
                "item_quantity" =>$record->quantity,
                "item_unit"     =>$record->unit,
            ); 
        }

        ## Response
        $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData"               => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode( $response ));

    }
}
