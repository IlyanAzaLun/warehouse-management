<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_invoice extends CI_Model {

        private $_table = "tbl_invoice";

        public function invoice_select($data = false, $like = false)
        {
        	if ($data) {
	        	$this->db->select(
	        		'invoice.invoice_id
	        		,invoice.date
	        		,invoice.date_due
	        		,invoice.to_customer_destination
	        		,user_info.user_fullname
	        		,user_info.user_address
	        		,user_info.village
	        		,user_info.sub-district
	        		,user_info.district
	        		,user_info.province
	        		,user_info.zip
	        		,user_info.user_contact_phone
	        		,user_info.user_contact_email
	        		,invoice.order_id as invoice_order_id
	        		,invoice.sub_total
	        		,invoice.discount
	        		,invoice.shipping_cost
	        		,invoice.other_cost
	        		,invoice.grand_total
	        		,invoice.status_payment
	        		,invoice.status_item
	        		,invoice.status_validation
	        		,invoice.status_active
	        		,invoice.status_settlement
	        		,invoice.note');
	        	$this->db->join('tbl_user_information user_info', 'invoice.to_customer_destination = user_info.user_id', 'left');
	            return $this->db->get_where($this->_table.' invoice', array('invoice.invoice_id'=>$data))->row_array();
        	}else{

	        	$this->db->select(
	        		'invoice.invoice_id
	        		,invoice.date
	        		,invoice.date_due
	        		,invoice.to_customer_destination
	        		,user_info.user_fullname
	        		,user_info.user_address
	        		,user_info.village
	        		,user_info.sub-district
	        		,user_info.district
	        		,user_info.province
	        		,user_info.zip
	        		,user_info.user_contact_phone
	        		,user_info.user_contact_email
	        		,invoice.order_id as invoice_order_id
	        		,invoice.status_item
	        		,invoice.status_validation
	        		,invoice.status_active
	        		,invoice.status_settlement
	        		,invoice.status_payment');
	        	$this->db->join('tbl_user_information user_info', 'invoice.to_customer_destination = user_info.user_id', 'left');
	        	$this->db->like('invoice.invoice_id', $like, 'after');
	        	$this->db->order_by('invoice.date', 'DESC');
	            return $this->db->get($this->_table.' invoice')->result_array();
        	}
        }
        public function invoice_insert($data)
        {
                return $this->db->insert($this->_table, $data);
        }
        public function invoice_update($data)
        {
        	$this->db->select($data['variabel']);
		$value = $this->db->get_where($this->_table, array('invoice_id' => $data['id'] ))->row_array();
		if ($data['variabel'] == 'status_settlement' AND $value[$data['variabel']] == 2) {
			$value[$data['variabel']] = 0;

		}elseif ($value[$data['variabel']] == 1) {

			$value[$data['variabel']] = 0;
		}else{
			(int)$value[$data['variabel']]++;
		}
                $this->db->where('invoice_id', $data['id']);
                return $this->db->update($this->_table, array($data['variabel'] => $value[$data['variabel']] ));
        }
        public function invoice_delete($data)
        {
                $this->db->where('invoice_code', $data['invoice_code']);
                return $this->db->delete($this->_table);
        }
}