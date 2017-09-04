<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersLog_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
	}

	public function login_log($data,$type,$status){

		$temp = [];
		$temp['users_log_type'] = $type;
		$temp['users_id'] = $data['users_id'];
		$temp['users_account_'.$status] = $data['users_account'];
		$temp['users_name_'.$status] = $data['users_name'];

		$this->db->insert('users_log', $temp);	

	}

	public function logout_log($data,$type,$status){

		$temp = [];
		$temp['users_log_type'] = $type;
		$temp['users_id'] = $data['userdata']['ubmsys_users_id'];
		$temp['users_account_'.$status] = $data['userdata']['ubmsys_users_account'];
		$temp['users_name_'.$status] = $data['userdata']['ubmsys_users_name'];

		$this->db->insert('users_log', $temp);	

	}
}