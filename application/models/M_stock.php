<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_stock extends CI_Model {

        private $_table = "tbl_item_history";
        private $_foreign_table = "tbl_item";

        public function history_item_select($data)
        {
            $this->db->where('item_code', $data['item_code']);
            return $this->db->get($this->_table)->result_array();
        }

        public function history_item_insert($data)
        {
            $this->db->insert($this->_table, $data['history']);
            $this->db->where('item_code', $data['item']['item_code']);
            return $this->db->update($this->_foreign_table, $data['item']);
        }

        public function history_item_insert_multiple($data)
        {
            foreach ($data['history'] as $key => $value) {
                $this->db->set('created_by', $this->data['user']['user_fullname']);
                $this->db->insert($this->_table, $value);
            }
            foreach ($data['item'] as $key => $value) {

                $this->db->set('update_by', $this->data['user']['user_fullname']);
                $this->db->set('update_at', 'NOW()', false);
                $this->db->where('item_code', $value['item_code']);
                $this->db->update($this->_foreign_table, $value);
            }
        }
}