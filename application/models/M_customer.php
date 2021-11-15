<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_customer extends CI_Model {

        private $_table = "tbl_customer";

        public function customer_select($data = false)
        {
        	if($data){
                $this->db->select(
                        'customer.customer_id
                        ,customer.customer_fullname
                        ,customer.customer_address
                        ,customer.customer_contact_phone
                        ');
                return $this->db->get_where($this->_table.' customer', ['customer_id'=>$data])->row_array();
            }else{
                $this->db->select(
                        'customer.customer_id
                        ,customer.customer_fullname
                        ');
                return $this->db->get($this->_table.' customer')->result_array();
            }
        }
        public function customer_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['customer_id']      =  $uuid;
                return $this->db->insert('tbl_customer', $data);

        }
}