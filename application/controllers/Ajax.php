<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_BackendController {
	public function __construct(){
		parent::__construct();

		$this->folder = $this->config->item('uploadPath').$this->config->item('tmpPath');
		$this->deletePath = $this->config->item('uploadPath').$this->config->item('deletePath');

		$this->defultCropController = array('news');

	}

	public function checkPassword(){
		$this->load->model('home_model');
		$returnData['result'] = 'NO';
		$users_password = $this->input->post('chk_password', true);
		$users_account = $this->session->userdata('ubmsys_users_account');
		$dbPassword = $this->sha256Decode(implode(" ",$this->home_model->checkUsersPassword($users_account)));

		if( $users_password == $dbPassword ){
			$returnData['result'] = 'YES';
		}
		echo json_encode($returnData);
	}
}
