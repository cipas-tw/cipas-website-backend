<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends MY_BackendModel {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'news_';
		$this->from = 'articles';
		$this->id = 'news_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'show_date';
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
		return $this->db->insert_id();
	}

	public function updateData($data){
		if( !isset($data[$this->abrv.'edited_date']) ){
			$data[$this->abrv.'edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'edited_user'] = $this->session->userdata('ubmsys_users_id');
		}

		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);
		return $result;
	}

	public function deleteData($data){
		if( !isset($data[$this->abrv.'edited_date']) ){
			$data[$this->abrv.'edited_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
			$data[$this->abrv.'edited_user'] = $this->session->userdata('ubmsys_users_id');
		}

		$data[$this->abrv.$this->is_del] = 1;

		$this->db->where($this->id, $data[$this->id]);
		$result = $this->db->update($this->from, $data);
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

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['news_type_id']) && $queryData['news_type_id'] !=''){
			$queryData['news_type_id'] = $this->db->escape($queryData['news_type_id']);
			$this->db->where('news_type_id', $queryData['news_type_id'], FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate'].' 00:00:00');
			$this->db->where('news_show_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate'].' 23:59:59');
			$this->db->where('news_show_date <=', $queryData['endDate'], FALSE);
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

	public function getNewsTypeList(){
		$this->db->from('articles_type')
				 ->where('news_type_is_del',0,false)
				 ->order_by('news_type_created_date', 'asc');

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function checkIsDuplicate($where){

		$this->db->from($this->from)
				 ->where($where);

		$result = $this->db->count_all_results() > 0 ? true : false;
		return $result;
	}
}