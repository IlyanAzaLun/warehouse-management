<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_users extends CI_Model {

        private $_table = "tbl_user";
        private $_foreign_table = "tbl_user_information";

        public function user_select($data = false)
        {
                if ($data) {
                        $this->db->select(
                                'user.user_id
                                ,user.user_fullname
                                ,user.user_email
                                ,user.user_image
                                ,user.role_id
                                ,user.is_active
                                ,user.created_at
                                ,role.role_name
                                ');
                        $this->db->join('tbl_role role', 'user.role_id = role.id', 'left');
                        $this->db->group_by('user.user_id');
                        return $this->db->get_where($this->_table.' user', ['user_email'=>$data])->row_array();
                }else{
                        $this->db->select(
                                'user.user_id
                                ,user.user_fullname
                                ,user.user_email
                                ,user.user_image
                                ,user.role_id
                                ,user.is_active
                                ,user.created_at
                                ,user_info.user_fullname as user_info_fullname
                                ,user_info.owner_name
                                ,user_info.user_address
                                ,user_info.village
                                ,user_info.sub-district
                                ,user_info.district
                                ,user_info.province
                                ,user_info.zip
                                ,user_info.user_contact_phone
                                ,user_info.user_contact_email
                                ,user_info.type_id
                                ,user_info.note
                                ,role.id as role_id
                                ,role.role_name as role_name
                        ');
                        $this->db->join('tbl_user_information user_info', 'user_info.user_id = user.user_id', 'left');
                        $this->db->join('tbl_role role', 'role.id = user.role_id ', 'left');
                        $this->db->group_by('user.user_id');
                        return $this->db->get('tbl_user user')->result_array();
                }
        }
        public function user_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['user_id']      =  $uuid;
                $data['user_image']   =  'assets/images/default.jpg';
                $data['role_id']      =  '752c0ad8-4925-11ec-8cc8-1be21be013bc';
                $data['is_active']    =  1;
                $this->db->set('created_at', 'NOW()', FALSE);
                return $this->db->insert('tbl_user', $data);

        }

        public function user_update($value)
        {
                $this->db->set('update_at', 'NOW()', FALSE);
                $this->db->set('update_by', $this->data['user']['user_fullname']);
                $this->db->where('user_id', $value['user_id']);
                $this->db->update($this->_table, $value);
        }

        public function user_info_select($data = false, $type = false)
        {
                if ($data) {
                        $this->db->where('user_id', $data['user_id']);
                        return $this->db->get($this->_foreign_table)->row_array();
                }else{
                        $this->db->join('tbl_role role', 'user_info.role_id = role.id', 'left');
                        $this->db->where('user_info.is_active', 1);
                        $this->db->where('role.role_name', $type);
                        return $this->db->get($this->_foreign_table.' user_info')->result_array();
                }
        }

        public function user_info_insert($data, $type)
        {
                $uuid = Uuid::uuid4();
                $data['user_id']      =  substr($type, 0, 1).sprintf("%04s",$this->db->get_where($this->_foreign_table, ['role_id' => $data['role_id']])->num_rows()+1);
                return $this->db->insert($this->_foreign_table, $data);
        }
}