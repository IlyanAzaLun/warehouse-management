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
            $this->db->set('quantity', 'quantity + '.$value['quantity'], false);
            $this->db->where('item_code', $value['item_code']);
            $this->db->update($this->_foreign_table);
        }
    }

    public function stock_update_multiple($data)
    {
        foreach ($data as $key => $value) {
            if ($key == 1) {
                continue;
            } else {
                $this->db->select('quantity');
                $this->db->where('item_code', $value['A']);
                $history[] =[
                    'item_code' => $value['A'],
                    'previous_quantity' => $this->db->get('tbl_item')->row_array()['quantity'],
                    'status_in_out' => 'UPDATE ('.$value['K'].')',
                    'created_by' => $this->data['user']['user_fullname'],
                    'updated_by' => $this->data['user']['user_fullname'],
                    'updated_at' => date('Y-m-d H:i:s',time()),
                ];
                $request[] = [
                    'item_code' => $value['A'],
                    'item_name' => $value['B'],
                    'item_category' => $value['C'],
                    'MG' => $value['D'],
                    'ML' => $value['E'],
                    'VG' => $value['F'],
                    'PG' => $value['G'],
                    'falvour' => $value['H'],
                    'brand_1' => $value['I'],
                    'brand_2' => $value['J'],
                    'quantity' => $value['K'],
                    'unit' => $value['L'],
                    'customs' => $value['M'],
                    'note' => $value['N'],
                    'update_by' => $this->data['user']['user_fullname'],
                    'update_at' => date('Y-m-d H:i:s',time()),
                ];
            }
        }

        $this->db->insert_batch('tbl_item_history', $history);
        return $this->db->update_batch('tbl_item', $request, 'item_code');
    }
}