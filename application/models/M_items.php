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
                return $this->db->insert('tbl_item', $data);
        }
        public function item_update($data)
        {
                $this->db->where('item_code', $data['item_code']);
                return $this->db->update($this->_table, $data);
        }
        public function item_delete($data)
        {
                $this->db->where('item_code', $data['item_code']);
                return $this->db->delete($this->_table);
        }
        
        //update quantity item
        public function item_update_quantity($id, $quantity)
        {
                $this->db->set('quantity', $quantity);
                $this->db->where('item_code', $id);
                return $this->db->update('tbl_item');
        }
}