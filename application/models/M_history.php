<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
class M_history extends CI_Model {

	private $_table = "tbl_item_history";

	public function history_insert_multiple($data)
	{
		return $this->db->insert_batch($this->_table, $data);
	}
}