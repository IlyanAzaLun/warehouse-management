<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_menu  extends CI_Model {

        private $_table = "tbl_user_menu";
        private $_forign_table = "tbl_user_menu_category";

        public function menu_select($data = false)
        {
        	$this->db->select(
        		'menu.menu_id as menu_id
        		,menu.title as title
                        ,menu.parent_id as parent_id
                        ,menu.menu_controller as menu_controller
        		,menu_category.category_name as category_name
        		,menu.url as url
        		,menu.icon as icon
        		,menu.is_active as is_active'
        	);
        	$this->db->join('tbl_user_menu_category menu_category', 'menu.category_id = menu_category.category_id', 'left')	;
        	$this->db->group_by('menu.menu_id');
            return $this->db->get($this->_table.' menu')->result_array();
        }
        public function menu_category_select($data = false)
        {
            return $this->db->get($this->_forign_table)->result_array();
        }
        public function menu_insert($data)
        {
                $uuid = Uuid::uuid4();
                $data['menu_id']      =  $uuid;
                return $this->db->insert($this->_table, $data);
        }
        public function menu_category_insert($data)
        {
                $uuid = Uuid::uuid4();
                $i = 0;
                foreach ($data['role'] as $key => $value) {
                        $access[$i]['category_id'] = $uuid;
                        $access[$i]['role_id']     = $key;
                        $this->db->set('id', 'uuid()', FALSE);
                        $this->db->insert('tbl_user_access_menu', $access[$i]);
                        $i++;
                }
                $category['category_id'] = $uuid;
                $category['category_name'] = $data['category_name'];
                return $this->db->insert($this->_forign_table, $category);
        }
}