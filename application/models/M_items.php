<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_items extends CI_Model
{
    private $_table = 'tbl_item';

    public function item_select($data = false)
    {
        if ($data) {
            $this->db->where('item_code', $data);
            return $this->db->get($this->_table)->row_array();
        } else {
            $this->db->select(
                'item_code
                ,item_code_ipos
                ,item_name
                ,item_category
                ,quantity
                ,unit');
            return $this->db->get($this->_table)->result_array();
        }
    }

    public function item_select_by_code($data, $limit)
    {
        $this->db->limit($limit);
        $this->db->where('item_code', $data);
        $this->db->where('is_active', 1);
        return $this->db->get('tbl_item')->row_array();
    }

    public function item_select_like_name($data, $limit)
    {
        $this->db->limit($limit);
        $this->db->like('item_name',$data,'both');
        $this->db->where('is_active', 1);
        return $this->db->get('tbl_item')->result_array();        
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
                    'created_by' => $this->data['user']['user_fullname'],
                ];
            }
        }
        return $this->db->insert_batch('tbl_item', $request);
    }
    public function item_update($data)
    {
        $this->db->where('item_code', $data['item_code']);
        $this->db->set('update_at', 'NOW()', FALSE);
        $this->db->set('update_by', $this->data['user']['user_fullname']);
        return $this->db->update($this->_table, $data);
    }
    public function item_delete($data)
    {
        $this->db->set('is_active',0);
        $this->db->where('item_code', $data['item_code']);
        return $this->db->update($this->_table);
    }

    //update quantity item
    public function item_update_quantity($id, $quantity)
    {
        $this->db->set('update_at', date('Y-m-d H:i:s',time()));
        $this->db->set('update_by', $this->data['user']['user_fullname']);
        $this->db->set('created_by', $this->data['user']['user_fullname']);

        $this->db->set('quantity', 'quantity +'.$quantity, false);
        $this->db->where('item_code', $id);
        return $this->db->update('tbl_item');
    }
    public function item_update_multiple($data)
    {
        return $this->db->update_batch('tbl_item', $data, 'item_code');
    }
    //
}
