<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

require_once APPPATH . 'controllers/User.php';
class Customer extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_customer');
    }

    public function index()
    {
        $this->data['title'] = 'Manajemen pelanggan';
        $this->data['customers'] = $this->M_users->user_info_select(false,'Customer');

        $this->data['plugins'] = [
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
            'module' => [base_url('assets/pages/user/customer/index.js')],
        ];

        $this->form_validation->set_rules('user_fullname','Nama penyedia barang','required|trim');
        $this->form_validation->set_rules('user_address','Alamat','required|trim');
        $this->form_validation->set_rules('village', 'Desa', 'required|trim');
        $this->form_validation->set_rules('sub-district','Kecamatan','required|trim');
        $this->form_validation->set_rules('district','Kabupaten','required|trim');
        $this->form_validation->set_rules('province','Provnsi','required|trim');
        $this->form_validation->set_rules('zip', 'Kode pos', 'required|trim');
        $this->form_validation->set_rules('user_contact_phone','Kontak Telepon','required|trim');
        $this->form_validation->set_rules('user_contact_email','Kontak Email','required|trim|valid_email');
        $this->form_validation->set_rules('type_id','Kategori','required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/customer/index', $this->data);
            $this->load->view('user/customer/modals');
        } else {
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
                'role_id'            => '752c0ad8-4925-11ec-8cc8-1be21be013bc',
                'note'               => htmlspecialchars($this->input->post('note', true)),
            ];
            try {
                $this->M_users->user_info_insert($this->data, 'Customer'); // this id for role on tbl_role
                Flasher::setFlash('info','success','Success',' congratulation success to entry data!');
                redirect('customer');
            } catch (Exception $e) {
                Flasher::setFlash('info','error','Failed','  to entry data!, ' . $e);
                redirect('customer');
            }
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
                $extension = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION
                );

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv(); //not problem
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // $reader = new \PhpOffice\PhpSpreadsheet\IOFactory();
                // file path
                $spreadsheet    = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                // array Count
                if ($this->M_customer->customer_insert_multiple($allDataInSheet) > 0) {
                    Flasher::setFlash('info','success',',Success !',',to add your students');
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    Flasher::setFlash('info','warning',',Error !',',check again your data if updateed don\'t worry' .
                            validation_errors());
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
            if ((
            $extension == 'xlsx' ||
            $extension == 'xls' ||
            $extension == 'csv') &&
            in_array($_FILES['file']['type'], $file_mimes)){
                return true;
            } else {
                $this->form_validation->set_message('checkFileValidation','Please choose correct file.');
                Flasher::setFlash('info','error','Failed',' something worng to update data! ' . validation_errors());
                redirect('items');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkFileValidation','Please choose a file.');
            Flasher::setFlash('info','error','Failed',' something worng to update data! ' . validation_errors());
            redirect('items');
            return false;
        }
    }
}
