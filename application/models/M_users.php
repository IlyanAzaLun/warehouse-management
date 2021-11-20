<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_users extends CI_Model {

        private $_table = "tbl_user";
        private $_foreign_table = "tbl_user_information";

        public function user_select($data)
        {
                $this->db->select(
                        'user.user_id
                        ,user.user_fullname
                        ,user.user_email
                        ,user.user_image
                        ,user.role_id
                        ,user.is_active
                        ,user.date_created
                        ,role.role_name
                        ');
                $this->db->join('tbl_role role', 'user.role_id = role.id', 'left');
                return $this->db->get_where($this->_table.' user', ['user_email'=>$data])->row_array();
        }
        public function user_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['user_id']      =  $uuid;
                $data['user_image']   =  'assets/images/default.jpg';
                $data['role_id']      =  '752c0ad8-4925-11ec-8cc8-1be21be013bc';
                $data['is_active']    =  1;
                $data['date_created'] =  time();
                return $this->db->insert('tbl_user', $data);

        }

        public function user_info_select($data, $type)
        {
                if ($data['user_id']) {
                        // code...
                }else{
                        $this->db->join('tbl_role role', 'user_info.role_id = role.id', 'left');
                        $this->db->where('role.role_name', $type);
                        return $this->db->get($this->_foreign_table.' user_info')->result_array();
                }
        }

        public function user_info_insert($data, $type)
        {
                $uuid = Uuid::uuid4();
                $data['user_id']      =  $uuid;
                $data['role_id']      =  $type;
                return $this->db->insert($this->_foreign_table, $data);
        }
}