<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Items extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
    }
    function index_get()
    {
       $id = $this->get('id');
        if ($id == '') {
            $produk = $this->db->get('tbl_item')->result();
        } else {
            $this->db->where('item_code', $id);
            $produk = $this->db->get('tbl_item')->result();
        }
        $this->response($produk, REST_Controller::HTTP_OK);
    }
}