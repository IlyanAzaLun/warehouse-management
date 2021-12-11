<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_order extends CI_Model {

        private $_table = "tbl_order";

        public function order_select($data = false)
        {
        	if ($data) {
	        	$this->db->select(
	        		' order.*
					, order.quantity as quantity_order
	        		, item.*');
	        	$this->db->join('tbl_item item', 'order.item_id = item.item_code', 'left');
	        	return $this->db->get_where($this->_table.' order', array('order.order_id'=>$data))->result_array();
        	}else{

	        	$this->db->select(
	        		'order.order_id
	        		,order.date
	        		,order.date_due
	        		,order.to_customer_destination
	        		,user_info.user_fullname
	        		,user_info.user_address
	        		,user_info.user_contact_phone
	        		,order.order_id as order_order_id
	        		,order.status_payment');
	        	$this->db->join('tbl_user_information user_info', 'order.to_customer_destination = user_info.user_id', 'left');
	        	return $this->db->get($this->_table.' order')->result_array();
        	}
        }

		public function order_insert($data)
		{
        	foreach ($data['order_id'] as $key => $value) {
        		$uuid = Uuid::uuid4();
    			$this->db->set('index_order', $uuid);
        		$this->db->set('order_id', $data['order_id'][$key]);
        		$this->db->set('item_id', $data['item_code'][$key]);
        		$this->db->set('capital_price', $data['item_capital_price'][$key]);
        		$this->db->set('selling_price', $data['item_selling_price'][$key]);
        		$this->db->set('quantity', $data['item_quantity'][$key]);
        		$this->db->set('unit', $data['item_unit'][$key]);
        		$this->db->set('rabate', $data['rebate_price'][$key]);
        		$this->db->set('user_id', $data['user_id'][$key]);
        		$this->db->set('date', $data['date'][$key]);
        		$this->db->insert($this->_table);
			}
		}
		
        public function order_insert_history_update_item($data) // paket komplit anjir
        {
        	$history = array();
        	foreach ($data['order_id'] as $key => $value) {
        		$uuid = Uuid::uuid4();
    			$this->db->set('index_order', $uuid);
        		$this->db->set('order_id', $data['order_id'][$key]);
        		$this->db->set('item_id', $data['item_code'][$key]);
        		$this->db->set('capital_price', $data['item_capital_price'][$key]);
        		$this->db->set('selling_price', $data['item_selling_price'][$key]);
        		$this->db->set('quantity', $data['item_quantity'][$key]);
        		$this->db->set('unit', $data['item_unit'][$key]);
        		$this->db->set('rabate', $data['rebate_price'][$key]);
        		$this->db->set('user_id', $data['user_id'][$key]);
        		$this->db->set('date', $data['date'][$key]);
        		$this->db->insert($this->_table);

        		//create history
        		$this->db->select('item_code, capital_price, selling_price, quantity');
        		$this->db->where('item_code', $data['item_code'][$key]);
        		array_push($history,$this->db->get('tbl_item')->row_array()); // tmp
				$this->db->set('item_code' , $history[$key]['item_code']);
				$this->db->set('previous_capital_price' , $history[$key]['capital_price']);
				$this->db->set('previous_selling_price' , $history[$key]['selling_price']);
				$this->db->set('previous_quantity' , $history[$key]['quantity']);
				$this->db->set('status_in_out' , $data['status_in_out'][$key].' ('.$data['item_quantity'][$key].')');
				$this->db->set('update_at' , time());
				$this->db->insert('tbl_item_history');

        		//update item
        		$this->db->set('capital_price', $data['item_capital_price'][$key]);
        		$this->db->set('selling_price', $data['item_selling_price'][$key]);
        		$this->db->set('quantity', (int)$history[$key]['quantity']+(int)$data['item_quantity'][$key]);
        		$this->db->where('item_code', $data['item_code'][$key]);
        		$this->db->update('tbl_item');
        	}
        }
        public function order_update($data)
        {
                $this->db->where('order_code', $data['order_code']);
                return $this->db->update($this->_table, $data);
        }
        public function order_delete($data)
        {
                $this->db->where('order_code', $data['order_code']);
                return $this->db->delete($this->_table);
        }
}