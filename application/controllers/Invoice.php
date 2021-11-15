<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

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
		$this->load->model('M_menu');
		$this->load->model('M_invoice');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
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
		$this->data['title'] = 'Invoice management';
		$this->data['invoices'] = $this->M_invoice->invoice_select();
		$this->data['categorys'] = $this->M_menu->menu_category_select();

		$this->form_validation->set_rules('category', 'Category invoice', 'required|trim');
		$this->form_validation->set_rules('invoice_code', 'Code invoice', 'required|trim');
		$this->form_validation->set_rules('invoice_name', 'invoice name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		$this->form_validation->set_rules('unit', 'Unit', 'required|trim');
		$this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim|integer');
		$this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|integer|greater_than['.$this->input->post('capital_price').']');
		if ($this->form_validation->run()==false) {
			$this->load->view('invoice/index', $this->data);
			$this->load->view('invoice/modals');
		}else{
			$this->data = [
				'invoice_category'      => htmlspecialchars($this->input->post('category', true)),
				'invoice_code'     => htmlspecialchars($this->input->post('invoice_code', true)),
				'invoice_name'     => htmlspecialchars($this->input->post('invoice_name', true)),
				'quantity'      => htmlspecialchars($this->input->post('quantity', true)),
				'unit'          => htmlspecialchars($this->input->post('unit', true)),
				'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
				'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
			];
			$this->M_invoice->invoice_insert($this->data);
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
			redirect('invoice');
		}
	}

	public function info()
	{
		$this->data['title'] = 'Invoice';
		$this->load->view('invoice/info-invoice', $this->data);
	}

	public function customer()
	{
		if ($this->input->post('request')) {
			if ($this->input->post('data')) {
				$this->data = $this->db->get_where('tbl_customer', array('customer_fullname' => $this->input->post('data')))->row_array();
				if ($this->data) {
					echo json_encode($this->data);
				}else{
					echo json_encode($data = array(
						'customer_id' => '', 
						'customer_contact_phone' => '', 
						'customer_address' => '', 
					));
				}
			}else{
				echo json_encode($this->db->get('tbl_customer')->result_array());
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
}
