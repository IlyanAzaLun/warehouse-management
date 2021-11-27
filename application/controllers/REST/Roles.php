<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Roles extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
    }
    function index_get() {
        $id = $this->get('id');
        if ($id != '') {
            $result = $this->db->get('tbl_role')->result_array();
        } else {
            $result = $this->db->get('tbl_role')->result_array();
        }
        array_unshift($result, array('id' => '', 'role_name' => ''));
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