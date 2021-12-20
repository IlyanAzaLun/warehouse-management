<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_customer extends CI_Model
{
    private $_table = 'tbl_customer';

    public function customer_select($data = false)
    {
        if ($data) {
            return $this->db
                ->get_where($this->_table . ' customer', [
                    'customer_id' => $data,
                ])
                ->row_array();
        } else {
            return $this->db->get($this->_table)->result_array();
        }
    }
    public function customer_insert($data)
    {
        $uuid = Uuid::uuid4();
        $data['customer_id'] = $uuid;
        return $this->db->insert('tbl_customer', $data);
    }

    public function customer_insert_multiple($data)
    {
        foreach ($data as $key => $value) {
            if ($key == 1) {
                continue;
            } else {
                $request[] = [
                    'user_id' => $value['A'],
                    'user_fullname' => $value['B'],
                    'owner_name' => $value['C'],
                    'user_address' => $value['D'],
                    'village' => $value['E'],
                    'sub-district' => $value['F'],
                    'district' => $value['G'],
                    'province' => $value['H'],
                    'zip' => $value['I'],
                    'user_contact_phone' => $value['J'],
                    'user_contact_email' => $value['K'],
                    'note' => $value['L'],
                    'type_id' => $value['M'],
                    'role_id' => '752c0ad8-4925-11ec-8cc8-1be21be013bc',
                    'is_active' => 0,
                ];
            }
        }
        return $this->db->insert_batch('tbl_user_information', $request);
    }
}
