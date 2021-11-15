<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_users extends CI_Model {

        private $_table = "tbl_user";

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
                $data['role_id']      =  'c046d399-40f9-11ec-ae08-0d3b0460d819';
                $data['is_active']    =  1;
                $data['date_created'] =  time();
                return $this->db->insert('tbl_user', $data);

        }
}