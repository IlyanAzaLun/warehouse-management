<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_role extends CI_Model {

        private $_table = "tbl_role";

        public function role_select($data = false)
        {
            $this->db->select(
                    'role.id
                    ,role.role_name
                    ');
            return $this->db->get($this->_table.' role')->result_array();
        }
        public function role_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['role_id']      =  $uuid;
                return $this->db->insert('tbl_role', $data);

        }
}