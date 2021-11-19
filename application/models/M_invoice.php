<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_invoice extends CI_Model {

        private $_table = "tbl_invoice";

        public function invoice_select($data = false)
        {
        	if ($data) {
	        	$this->db->select(
	        		'invoice.invoice_id
	        		,invoice.date
	        		,invoice.date_due
	        		,invoice.to_customer_destination
	        		,user_info.user_fullname
	        		,user_info.user_address
	        		,user_info.user_contact_phone
	        		,invoice.order_id as invoice_order_id
	        		,invoice.sub_total
	        		,invoice.tax
	        		,invoice.discount
	        		,invoice.grand_total
	        		,invoice.status_payment
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
	        		,user_info.user_contact_phone
	        		,invoice.order_id as invoice_order_id
	        		,invoice.status_payment');
	        	$this->db->join('tbl_user_information user_info', 'invoice.to_customer_destination = user_info.user_id', 'left');
	            return $this->db->get($this->_table.' invoice')->result_array();
        	}
        }
        public function invoice_insert($data)
        {
                $data['image_id'] =  'assets/images/LQD-001.jpg';
                return $this->db->insert($this->_table, $data);
        }
        public function invoice_update($data)
        {
                $this->db->where('invoice_code', $data['invoice_code']);
                return $this->db->update($this->_table, $data);
        }
        public function invoice_delete($data)
        {
                $this->db->where('invoice_code', $data['invoice_code']);
                return $this->db->delete($this->_table);
        }
}