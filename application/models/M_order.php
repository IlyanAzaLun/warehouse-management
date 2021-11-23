<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_order extends CI_Model {

        private $_table = "tbl_order";

        public function order_select($data = false)
        {
        	if ($data) {
	        	$this->db->select(
	        		' order.index_order
	        		, order.order_id
	        		, order.item_id
	        		, item.item_name
	        		, order.price
	        		, order.quantity
	        		, order.unit');
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
        		$this->db->set('price', $data['item_price'][$key]);
        		$this->db->set('quantity', $data['item_quantity'][$key]);
        		$this->db->set('unit', $data['item_unit'][$key]);
        		$this->db->insert($this->_table);
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