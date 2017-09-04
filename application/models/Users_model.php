<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'users_';
		$this->from = 'users';
		$this->id = 'users_id';
		$this->listSelect = 'users.*';
		$this->rowSelect = 'users.*';
		$this->orderBy = 'created_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';

	}

	public function addData($data){
		if( !isset($data[$this->abrv.'created_date']) ){

			$data[$this->abrv.'created_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'created_user'] = $this->session->userdata('ubmsys_users_id');
			$data[$this->abrv.'edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'edited_user'] = $this->session->userdata('ubmsys_users_id');

		}
		$this->db->insert($this->from, $data);
		$this->write_log($data, $this->db->insert_id(),'0',"after");	 // log 紀錄
		return $this->db->insert_id();
	}

	public function updateData($data){
		$log_result = $this->write_log($this->getData($data[$this->id]), $data[$this->id],'1',"before");	// log 紀錄 修改前,並傳回log id

		if( !isset($data[$this->abrv.'edited_date']) ){
			$data[$this->abrv.'edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'edited_user'] = $this->session->userdata('ubmsys_users_id');
		}
		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);

		$this->write_log($this->getData($data[$this->id]), $data[$this->id],'1',"after",$log_result);		// log 紀錄 修改後
		return $result;
	}

	public function deleteData($data){
		$log_result = $this->write_log($this->getData($data[$this->id]), $data[$this->id],'1',"before");	 // log 紀錄 修改前,並傳回log id
		if( !isset($data[$this->abrv.'edited_date']) ){
			$data[$this->abrv.'edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'edited_user'] = $this->session->userdata('ubmsys_users_id');
		}

		$data[$this->abrv.$this->is_del] = 1;

		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);

		$this->write_log($this->getData($data[$this->id]), $data[$this->id],'2',"after",$log_result);		// log 紀錄 修改後
		return $result;
	}

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getPermissionLists($premission_id){
		$this->db->select('backend_menu_permission_lists')
				 ->from('permissions')
				 ->where('backend_menu_permission_id', $premission_id);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect.', backend_menu_permission_name')
				 ->from($this->from)
				 ->join('permissions', 'permissions.backend_menu_permission_id = '.$this->from.'.backend_menu_permission_id', 'left')
				 ->where($this->abrv.$this->is_del,0,false)
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

		if( isset($queryData['keyword']) && $queryData['keyword'] ){
			$this->db->where('('.$this->abrv.'name like "%'.$queryData['keyword'].'%" or '.
					$this->abrv.'account like "%'.$queryData['keyword'].'%" or '.
					$this->abrv.'email like "%'.$queryData['keyword'].'%" or '.
					$this->abrv.'phone like "%'.$queryData['keyword'].'%")', NULL, FALSE);
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

	public function checkIsDuplicate($where){

		$this->db->from($this->from)
				 ->where($where);

		$result = $this->db->count_all_results() > 0 ? true : false;
		return $result;
	}

	public function write_log($data,$user_id,$type,$status,$users_log_id = 0){
		$this->load->model('UsersLog_model');

		$temp = [];
		$temp['users_log_type'] = $type;
		$temp['users_id'] = $user_id;
		if(isset($data[$this->abrv.'is_del'])){
			$temp[$this->abrv.'is_del_'.$status] = $data[$this->abrv.'is_del'];
		}
		if( $type === '2'){
			$temp[$this->abrv.'is_del_'.$status] = 1;
		}
		$temp[$this->abrv.'account_'.$status] = $data[$this->abrv.'account'];
		$temp[$this->abrv.'password_'.$status] = $data[$this->abrv.'password'];
		$temp[$this->abrv.'name_'.$status] = $data[$this->abrv.'name'];
		$temp[$this->abrv.'email_'.$status] = $data[$this->abrv.'email'];
		$temp['backend_menu_permission_id_'.$status] = $data['backend_menu_permission_id'];
		$temp[$this->abrv.'created_date_'.$status] = $data[$this->abrv.'created_date'];
		$temp[$this->abrv.'created_user_'.$status] = $data[$this->abrv.'created_user'];
		$temp[$this->abrv.'edited_date_'.$status] = $data[$this->abrv.'edited_date'];
		$temp[$this->abrv.'edited_user_'.$status] = $data[$this->abrv.'edited_user'];

		if($users_log_id === 0){
			$this->db->insert('users_log', $temp);
		}else{
			$this->db->where('users_log_id', $users_log_id);
			$this->db->update('users_log', $temp);
		}

		return $this->db->insert_id();
	}
}