<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
		$this->from = 'permissions';
		$this->id = 'backend_menu_permission_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'created_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function addData($data){
		if( !isset($data['backend_menu_permission_created_date']) ){

			$data['backend_menu_permission_created_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data['backend_menu_permission_created_user'] = $this->session->userdata('ubmsys_users_id');
			$data['backend_menu_permission_edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data['backend_menu_permission_edited_user'] = $this->session->userdata('ubmsys_users_id');

		}
		$this->db->insert($this->from, $data);
		return $this->db->insert_id();
	}

	public function updateData($data){
		if( !isset($data['backend_menu_permission_edited_date']) ){
			$data['backend_menu_permission_edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data['backend_menu_permission_edited_user'] = $this->session->userdata('ubmsys_users_id');
		}

		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);
		return $result;
	}

	public function deleteData($data){
		if( !isset($data['backend_menu_permission_edited_date']) ){
			$data['backend_menu_permission_edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data['backend_menu_permission_edited_user'] = $this->session->userdata('ubmsys_users_id');
		}

		$data['backend_menu_permission_'.$this->is_del] = 1;

		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);
		return $result;
	}

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where('backend_menu_permission_'.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where('backend_menu_permission_'.$this->is_del,0,false)
				 ->order_by('backend_menu_permission_'.$this->orderBy, $this->orderType);

		if( isset($queryData['keyword']) && $queryData['keyword'] ){
			$this->db->like('backend_menu_permission_name', $queryData['keyword']);
		}

		if( $limit ){
			if( $limit[0] != 0 ){
				$this->db->limit($limit[0], $limit[1]);
			}
			$result = $this->db->get();
			$result = $result->result_array();
		}else{
			$result = $this->db->count_all_results();
		}
		return $result;
	}
}