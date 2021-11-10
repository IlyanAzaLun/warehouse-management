<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_items extends CI_Model {

        private $_table = "tbl_item";

        public function item_select($data = false)
        {
                return $this->db->get_where($this->_table)->result_array();
        }
        public function item_insert($data)
        {
                $data['image_id'] =  'assets/image/LQD-001.jpg';
                return $this->db->insert('tbl_item', $data);
        }
}