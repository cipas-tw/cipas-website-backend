<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_BackendModel extends CI_Model {

	protected $model = '';
	protected $from = '';
	protected $id = '';
	protected $listSelect = '*';
	protected $rowSelect = '*';
	protected $orderBy = 'created_date';
	protected $orderType = 'DESC';
	protected $abrv = '';
	protected $is_del = 'is_del';
	protected $status = 'status';

	public function __construct(){
		parent::__construct();
	}

}