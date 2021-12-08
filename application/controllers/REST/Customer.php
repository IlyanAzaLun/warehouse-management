<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Customer extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
    }
    function index_get()
    {
       $this->db->where('role_id', '752c0ad8-4925-11ec-8cc8-1be21be013bc');
        if ($this->get('name-customer') == '') {
            $result = $this->db->get('tbl_user_information')->row_array();
        } else {
            $this->db->where('user_fullname', $this->get('name-customer'));
            $result = $this->db->get('tbl_user_information')->result_array();
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
}