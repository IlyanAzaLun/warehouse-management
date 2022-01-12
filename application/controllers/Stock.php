<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Stock extends CI_Controller {

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

	public function __construct(){
		parent::__construct();
		is_signin(get_class($this));
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_menu');
		$this->load->model('M_items');
		$this->load->model('M_stock');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
	}
	public function index(){
		$this->data['plugins'] = array(
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
                base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/jszip/jszip.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.html5.min.js'),
                // base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'),
                base_url('assets/AdminLTE-3.0.5/plugins/inputmask/min/jquery.inputmask.bundle.min.js'),
            ],
			'module' => [
				base_url('assets/pages/stock/index.js'),
			],
		);
		$this->data['title'] = 'Manajemen persediaan barang';
		// $this->data['items'] = $this->M_items->item_select();

		$this->load->view('stock/index', $this->data);
		$this->load->view('stock/modals');
	}
	public function restock()
	{
		$this->data['plugins'] = array(
			'css' => [
			],
			'js' => [
			],
			'module' => [
				base_url('assets/pages/stock/index-restock.js'),
			],
		);
		$this->form_validation->set_rules('item_code', 'Code item', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		// $this->form_validation->set_rules('unit', 'Unit item', 'required|trim');
		// $this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim');
		// $this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|greater_than['.$this->input->post('capital_price').']');
		if ($this->form_validation->run()==false) {
			$this->data['title'] = 'Tambah persediaan barang';
			$this->data['items'] = $this->M_items->item_select($this->input->get('id'));
			$this->load->view('stock/restock', $this->data);
		}else{
			$this->_history_insert();
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
			redirect('stocks');
		}
	}
	private function _history_insert()
	{
		$this->request['history'] = [
			'item_code'              => htmlspecialchars($this->input->post('item_code', true)),
			'previous_quantity'      => htmlspecialchars($this->input->post('quantity', true)),
			'previous_capital_price' => htmlspecialchars($this->input->post('previous_capital_price', true)),
			'previous_selling_price' => htmlspecialchars($this->input->post('previous_selling_price', true)),
			'status_in_out'          => htmlspecialchars(((int)$this->input->post('add_quantity', true)<0)?
                'OUT'. ' (' . abs($this->input->post('add_quantity', true)) . ')':
                'IN' . ' (' . abs($this->input->post('add_quantity', true)) . ')'),
			'created_at'             => date('Y-m-d H:i:s',time()),
			'created_by'             => $this->data['user']['user_fullname'],
		];
		$this->request['item'] = [
			'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
			'quantity'      => htmlspecialchars((int)$this->input->post('add_quantity', true)+(int)$this->input->post('quantity', true)),
			'unit'          => htmlspecialchars($this->input->post('unit', true)),
			'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
			'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
			'update_at'     => date('Y-m-d H:i:s',time()),
			'update_by'     => $this->data['user']['user_fullname'],
		];
		$this->M_stock->history_item_insert($this->request);
	}
	// file upload functionality
    public function import()
    {
        $data = [];
        $this->form_validation->set_rules('file','Upload File','callback_checkFileValidation');
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
                if ($this->M_stock->stock_update_multiple($allDataInSheet) > 0) {
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
}