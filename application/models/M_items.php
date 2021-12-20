<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_items extends CI_Model
{
    private $_table = 'tbl_item';

    public function item_select($data = false)
    {
        return $this->db->get_where($this->_table)->result_array();
    }
    public function item_insert($data)
    {
        return $this->db->insert('tbl_item', $data);
    }

    public function item_insert_multiple($data)
    {
        foreach ($data as $key => $value) {
            if ($key == 1) {
                continue;
            } else {
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
                ];
            }
        }
        return $this->db->insert_batch('tbl_item', $request);
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
