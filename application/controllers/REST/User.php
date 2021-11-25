<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
    }
    public function index_post()
    {
       $id = $this->post('id');
        if ($id == '') {
            $produk = $this->db->get('tbl_user_information')->result();
        } else {
            $this->db->where('user_id', $id);
            $produk = $this->db->get('tbl_user_information')->result();
        }
        $this->response($produk, REST_Controller::HTTP_OK);
    }
}