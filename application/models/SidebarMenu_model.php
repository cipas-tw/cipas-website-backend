<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SidebarMenu_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
	}

	public function getList(){
		$this->db->select("*")
				 ->from("backend_menu")
				 ->where("backend_menu_is_del",0,false)
				 ->order_by("backend_menu_sort", 'ASC');
		$rows = $this->db->get();
		return $rows->result_array();
	}
}