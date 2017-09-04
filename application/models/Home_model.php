<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'users_';
		$this->from = 'users';
		$this->id = 'users_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'created_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function checkUsersLogin($users_account, $users_password){
		$this->db->from($this->from)
				 ->where($this->abrv.'account', $users_account)
				 ->where($this->abrv.'password', $users_password)
				 ->where($this->abrv.$this->is_del, 0, false)
				 ->where($this->abrv.$this->status, 1, false);

		$result = $this->db->count_all_results();
		return $result;
	}

	public function checkUsersAccount($users_account){
		$this->db->from($this->from)
				 ->where($this->abrv.'account', $users_account)
				 ->where($this->abrv.$this->is_del, 0, false)
				 ->where($this->abrv.$this->status, 1, false);

		$result = $this->db->count_all_results();
		return $result;
	}

	public function getUsersData($users_account){
		$this->db->select('users_id, users_name, users_account')
				 ->from($this->from)
				 ->where($this->abrv.'account', $users_account)
				 ->where($this->abrv.$this->is_del, 0, false)
				 ->where($this->abrv.$this->status, 1, false);

		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getUsersEmail($users_account){
		$this->db->select('users_email')
				 ->from($this->from)
				 ->where($this->abrv.'account', $users_account)
				 ->where($this->abrv.$this->is_del, 0, false)
				 ->where($this->abrv.$this->status, 1, false);

		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function checkUsersPassword($users_account){
		$this->db->select('users_password')
				 ->from($this->from)
				 ->where($this->abrv.'account', $users_account)
				 ->where($this->abrv.$this->is_del, 0, false)
				 ->where($this->abrv.$this->status, 1, false);

		$rows = $this->db->get();
		return $rows->row_array();
	}

}