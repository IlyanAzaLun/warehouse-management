<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->model('M_menu');
		$this->load->model('M_items');
		$this->load->model('M_stock');
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
			'module' => [
				base_url('assets/pages/stock/index.js'),
			],
		);
		$this->data['title'] = 'Manajemen persediaan barang';
		$this->data['items'] = $this->M_items->item_select();
		$this->data['categorys'] = $this->M_menu->menu_category_select();

		$this->form_validation->set_rules('item_code', 'Code item', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		$this->form_validation->set_rules('unit', 'Unit item', 'required|trim');
		$this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim');
		$this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|greater_than['.$this->input->post('capital_price').']');
		if ($this->form_validation->run()==false) {
			$this->load->view('stock/index', $this->data);
			$this->load->view('stock/modals');
		}else{
			$this->_history_insert();
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
			redirect('stocks');
		}
	}
	private function _history_insert()
	{
		$this->request['history'] = [
			'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
			'previous_quantity'      => htmlspecialchars($this->input->post('quantity', true)),
			'previous_capital_price' => htmlspecialchars($this->input->post('previous_capital_price', true)),
			'previous_selling_price' => htmlspecialchars($this->input->post('previous_selling_price', true)),
			'update_at' => time(),
		];
		$this->request['item'] = [
			'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
			'quantity'      => htmlspecialchars((int)$this->input->post('add_quantity', true)+(int)$this->input->post('quantity', true)),
			'unit'      	=> htmlspecialchars($this->input->post('unit', true)),
			'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
			'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
		];
		$this->M_stock->history_item_insert($this->request);
	}

	/* not used
	public function getcode()
	{
		echo json_encode($this->db->get_where('tbl_item', ['item_category'=>$this->input->post('data')])->num_rows());
	}
	*/

	public function getitem()
	{
		echo json_encode($this->db->get_where('tbl_item', ['item_code'=>$this->input->post('data')])->row_array());
	}

	public function gethistory()
	{
		$this->db->order_by('update_at', 'DESC');
		echo json_encode($this->db->get_where('tbl_item_history', ['item_code'=>$this->input->post('data')])->result_array());
	}
}