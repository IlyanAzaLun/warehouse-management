<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Order extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
		$this->load->model('M_order');
    }
    function index_get()
    {
       $id = $this->get('id');
        if ($id == '') {
            $produk = $this->db->get('tbl_order')->result();
        } else {
            $this->db->where('order_id', $id);
            $this->db->select('order.*, item.*');
            $this->db->join('tbl_item item', 'order.item_id = item.item_code', 'left');
            $produk = $this->db->get('tbl_order order')->result();
        }
        $this->response($produk, REST_Controller::HTTP_OK);
    }
}