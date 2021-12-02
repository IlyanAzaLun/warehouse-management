<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
    }
    function index_get() {
        header('Content-Type: application/json');
        if ($this->input->get('id') OR $this->input->get('user_fullname') OR $this->input->get('user_email') OR $this->input->get('role_id')) {
            $this->db->select(
                'user.*
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
                ');
            $this->db->join('tbl_user_information user_info', 'user_info.user_id = user.user_id', 'left');
            $this->db->join('tbl_role role', 'user.role_id = role.id', 'left');
            $this->db->like('user.user_id', $this->input->get('id'), 'both');
            $this->db->like('user.user_fullname', $this->input->get('user_fullname'), 'both');
            $this->db->like('user.user_email', $this->input->get('user_email'), 'both');
            $this->db->like('user.role_id', $this->input->get('role_id'), 'both');
            $this->db->group_by('user.user_id');

            $result = $this->db->get('tbl_user user')->row_array();
        } else {
            header('Content-Type: application/json');
            $this->db->select(
                'user.*
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
                ');
            $this->db->join('tbl_role role', 'user.role_id = role.id', 'left');
            $this->db->join('tbl_user_information user_info', 'user_info.role_id = role.id', 'left');
            $result = $this->db->get('tbl_user user')->result_array();
        }
        $this->response($result, 200);
    }

    function index_post() {
        $data = array(
            'id'           => $this->post('id'),
            'nama'          => $this->post('nama'),
            'nomor'    => $this->post('nomor'));
        $insert = $this->db->insert('telepon', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
            'id'       => $this->put('id'),
            'nama'          => $this->put('nama'),
            'nomor'    => $this->put('nomor'));
        $this->db->where('id', $id);
        $update = $this->db->update('telepon', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}