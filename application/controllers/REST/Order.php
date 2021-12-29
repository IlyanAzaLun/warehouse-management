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
            $this->db->select('order.*, order.quantity as quantity_order, item.*');
            $this->db->join('tbl_item item', 'order.item_id = item.item_code', 'left');
            $this->db->order_by('order.date', 'DESC');
            $produk = $this->db->get('tbl_order order')->result();
        }
        $this->response($produk, REST_Controller::HTTP_OK);
    }

    function index_post()
    {
        $id_invoice   = $this->input->post('id');
        $this->db->where('invoice_reverence', $id_invoice);
        $data_invoice = $this->db->get('tbl_invoice')->row_array();
        $this->db->where('order_id', $data_invoice['order_id']);
        $this->db->select(
            ' order.order_id
            , order.item_id
            , order.quantity as quantity_order
            , order.unit
            , order.date
            , item.item_name
            , item.MG
            , item.ML
            , item.VG
            , item.PG
            , item.falvour
            , item.quantity'
        );
        $this->db->join('tbl_item item', 'order.item_id = item.item_code', 'left');
        $this->db->order_by('order.date', 'DESC');
        $produk = $this->db->get('tbl_order order')->result();
        $this->response($produk, REST_Controller::HTTP_OK);
    }
}