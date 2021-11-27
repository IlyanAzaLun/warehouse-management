<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_customer extends CI_Model {

        private $_table = "tbl_customer";

        public function customer_select($data = false)
        {
                if($data){
                        return $this->db->get_where($this->_table.' customer', ['customer_id'=>$data])->row_array();
                }else{
                        return $this->db->get($this->_table)->result_array();
                }
        }
        public function customer_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['customer_id'] =  $uuid;
                return $this->db->insert('tbl_customer', $data);

        }
}