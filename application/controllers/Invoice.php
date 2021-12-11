<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Invoice extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_menu');
		$this->load->model('M_invoice');
		$this->load->model('M_order');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
    }

    protected function add_invoice()
    {
		$this->db->group_by('order_id');
		$order_id   = sprintf("Or-%010s", $this->db->get('tbl_order')->num_rows()+1);
		$invoice_id = sprintf("IV/SEL/%010s", $this->db->get('tbl_invoice')->num_rows()+1);

		foreach ($this->input->post('item_code', true) as $key => $value) {
			$this->request['order']['order_id'][$key]     = $order_id;
			$this->request['order']['item_code'][$key]     = $this->input->post('item_code', true)[$key];
			$this->request['order']['item_price'][$key]    = $this->input->post('item_price', true)[$key];
			$this->request['order']['item_quantity'][$key] = $this->input->post('quantity', true)[$key];
			$this->request['order']['item_unit'][$key]     = $this->input->post('unit', true)[$key];
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

		$this->invoice = [
			'invoice_id'              => $invoice_id,
			'date'                    => time(),
			'date_due'                => time()+(7 * 24 * 60 * 60), //7 days; 24 hours; 60 mins; 60 secs
			'to_customer_destination' => $this->request['user_id'],
			'order_id'                => $this->request['order_id'],
			'sub_total'               => $this->request['sub_total'],
			'discount'           	  => $this->request['discount'],
			'shipping_cost'           => $this->request['shipping_cost'],
			'other_cost'              => $this->request['other_cost'],
			'grand_total'             => $this->request['grand_total'],
			'status_active'           => 1,
			'status_item'             => 0,
			'status_validation'       => 0,
			'status_payment'          => 0,
			'status_settlement'       => 0,
			'note'                    => $this->request['note']
		];

		$this->M_order->order_insert_history_update_item($this->request['order']);
		$this->M_invoice->invoice_insert($this->invoice);
		
		Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
		redirect($_SERVER['HTTP_REFERER']);
    }
    public function info_invoice()
    {
		$this->data['invoice'] = $this->M_invoice->invoice_select($this->input->get('id', true));
		$this->data['orders']  = $this->M_order->order_select($this->data['invoice']['invoice_order_id']);
    }
    public function update_invoice()
    {
    	if($this->input->post('data', true)['variabel'] != 'status_item'){
    		$this->M_invoice->invoice_update($this->input->post('data', true));
    		Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
			redirect($_SERVER['HTTP_REFERER']);
    	}
    	return false;
    }
    public function cancel_invoice() //return invoice
    {
    	if ($this->input->post('request')) {
    		$items = [];
    		foreach ($this->db->get_where('tbl_order', array('order_id' => $this->db->get_where('tbl_invoice', array('invoice_id' => 
    			$this->input->post('invoice_id')))->row_array()['order_id']))->result_array() as $key => $order) {
    			if ((int)$order['quantity'] <= 0) {
					$item[$key]['item_id']       = $order['item_id'];
					$item[$key]['quantity']      = abs($order['quantity']);
					$item[$key]['status_in_out'] = 'IN';
    			}else{
					$item[$key]['item_id']       = $order['item_id'];
					$item[$key]['quantity']      = (-1*(int)$order['quantity']);
					$item[$key]['status_in_out'] = 'OUT';
    			}
    			$data[$key] = $this->db->get_where('tbl_item', array('item_code'=> $item[$key]['item_id']))->row_array();

    			//history
				$this->db->set('item_code' , $item[$key]['item_id']);
				$this->db->set('previous_quantity' , $data[$key]['quantity']);
				$this->db->set('status_in_out' , $item[$key]['status_in_out'].' ('.$item[$key]['quantity'].', RETURN)');
				$this->db->set('update_at' , time());
				$this->db->insert('tbl_item_history');

    			$this->db->set('quantity', '`quantity` +'.$item[$key]['quantity'], false);
    			$this->db->where('item_code', $item[$key]['item_id']);
    			$this->db->update('tbl_item');

    		}
    		$this->db->set('status_active', $this->input->post('invoice_status', true));
    		$this->db->where('invoice_id', $this->input->post('invoice_id', true));
    		$this->db->update('tbl_invoice');

    		//find order by invoice_order_id, if purcesing canceled the quantiry of item is decrise the get from the value
    		//but if selling canceled the quantity of item is ingcrise the get from the value
    		//finaly the action entry to the history. with note parameters.

    		Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
			redirect($_SERVER['HTTP_REFERER']);
    	}else{
    		Flasher::setFlash('info', 'error', 'Failed', ' something was worng information!');
			redirect($_SERVER['HTTP_REFERER']);
    	}
    }
}